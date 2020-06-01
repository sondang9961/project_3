<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Request;
use App\Model\Lop;
use App\Model\Sach;
use App\Model\MonHoc;
use App\Model\SinhVien;
use DB;

class ThongKeController extends Controller
{
	private $folder = 'thong_ke';

	public function view_thong_ke_sinh_vien()
	{
		$array_lop = Lop::all();

		$array_sach = Sach::all();

		$ma_lop = Request::get('ma_lop');
		$ma_sach = Request::get('ma_sach');

		$array_not_in = SinhVien::query()
			->join('dang_ky_sach','sinh_vien.ma_sinh_vien','=','dang_ky_sach.ma_sinh_vien')
			->where('ma_lop','=',$ma_lop)
			->where('ma_sach','=',$ma_sach)->get(['sinh_vien.ma_sinh_vien']);

		$array_thong_ke_sinh_vien = DB::table('sinh_vien')
			->select(DB::raw('ma_sinh_vien,ten_sinh_vien,lop.ma_lop,ten_lop'))
			->join('lop','sinh_vien.ma_lop','=','lop.ma_lop')	
			->whereNotIn('ma_sinh_vien',$array_not_in)
			->where('sinh_vien.ma_lop','=',$ma_lop)
			->orderBy('ma_sinh_vien','desc')->paginate(2);
		
		$array_thong_ke_sinh_vien->appends(array(
			'ma_lop' => Input::get('ma_lop'),
			'ma_sach' => Input::get('ma_sach')
		));

		return view("$this->folder.view_thong_ke_sinh_vien",compact('array_thong_ke_sinh_vien','array_lop','array_sach','ma_lop','ma_sach'));
	}

	public function view_thong_ke_sach()
	{
		$search = Request::get('search');
		$start = Request::get('start');
		$end = Request::get('end');

		$array_thong_ke_sach = DB::table('sach')
								->select(DB::raw('
									*,
									if(a.so_luong_da_phat is null,0,a.so_luong_da_phat) as so_luong_da_phat,
									if(so_luong_nhap-so_luong_da_phat is null,so_luong_nhap,so_luong_nhap-so_luong_da_phat) as so_luong_ton_kho,
									ngay_nhap_sach'))
								
								->leftJoin(DB::raw('(select ma_sach,count(*) as so_luong_da_phat from dang_ky_sach where tinh_trang_nhan_sach = 1  group by ma_sach)a'),'a.ma_sach','=','sach.ma_sach')
								->join('mon_hoc','sach.ma_mon_hoc','=','mon_hoc.ma_mon_hoc');
		if(!empty($search)){
			$array_thong_ke_sach = $array_thong_ke_sach->where('ten_mon_hoc','like', '%'.$search.'%')
													   ->orWhere('ten_sach','like', '%'.$search.'%');
		}
		if(!empty($start)){
			$array_thong_ke_sach = $array_thong_ke_sach->where('ngay_nhap_sach','>=',$start);
		}
		if(!empty($end)){
			$array_thong_ke_sach = $array_thong_ke_sach->where('ngay_nhap_sach','<=',$end);
		}
		
		$array_thong_ke_sach = $array_thong_ke_sach->orderBy('sach.ngay_nhap_sach','desc')->paginate(5);

		$array_thong_ke_sach->appends(array(
			'search' => Input::get('search'),
			'start' => Input::get('start'),
			'end' => Input::get('end')
		));
		if(!empty($start) && !empty($end) && $start > $end){
			$message = 'Bạn phải nhập ngày bắt đầu nhỏ hơn ngày kết thúc !';
				return view("$this->folder.view_thong_ke_sach",
				compact('message','array_thong_ke_sach','search','start')
			);
		}
		if(count($array_thong_ke_sach) > 0){
			return view("$this->folder.view_thong_ke_sach",compact('array_thong_ke_sach','search','start'));
		}
		$message = 'Không tìm thấy sách, môn học!';
		return view("$this->folder.view_thong_ke_sach",compact('message','array_thong_ke_sach','search','start'));
	}

}