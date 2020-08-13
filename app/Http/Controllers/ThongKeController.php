<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Request;
use App\Model\Lop;
use App\Model\Sach;
use App\Model\KhoaHoc;
use App\Model\MonHoc;
use App\Model\SinhVien;
use App\Model\DangKySach;
use App\Exports\ThongKeSachExport;
use App\Exports\ThongKeSinhVienExport;
use Excel;
use DB;
use PDF;

class ThongKeController extends Controller
{
	private $folder = 'thong_ke';

	public function view_thong_ke_sinh_vien()
	{
		$array_khoa_hoc = KhoaHoc::all();	
		$array_lop = Lop::all();
		$array_sach = Sach::all();	

		$ma_lop = Request::get('ma_lop');
		$ma_sach = Request::get('ma_sach');
		$ma_khoa_hoc = Request::get('ma_khoa_hoc');

		$array_not_in = SinhVien::query()
			->join('dang_ky_sach','sinh_vien.ma_sinh_vien','=','dang_ky_sach.ma_sinh_vien')
			->where('ma_lop','=',$ma_lop)
			->where('ma_sach','=',$ma_sach)->get(['sinh_vien.ma_sinh_vien']);

		if(isset($ma_khoa_hoc) && isset($ma_lop) && isset($ma_sach)){
			$array_thong_ke_sinh_vien = DB::table('sinh_vien')
			->select(DB::raw('*'))
			->join('lop','sinh_vien.ma_lop','=','lop.ma_lop')	
			->whereNotIn('ma_sinh_vien',$array_not_in)
			->where('sinh_vien.ma_lop','=',$ma_lop)
			->orderBy('ma_sinh_vien','desc')->paginate(10);
		
			$array_thong_ke_sinh_vien->appends(array(
				'ma_lop' => Input::get('ma_lop'),
				'ma_sach' => Input::get('ma_sach'),
				'ma_khoa_hoc' => Input::get('ma_khoa_hoc'),
			));

			return view("$this->folder.view_thong_ke_sinh_vien",compact('array_thong_ke_sinh_vien','array_lop','array_sach','array_khoa_hoc','ma_lop','ma_sach','ma_khoa_hoc'));
		}
		$array_thong_ke_sinh_vien = [];
		return view("$this->folder.view_thong_ke_sinh_vien",compact('array_thong_ke_sinh_vien','array_lop','array_sach','array_khoa_hoc','ma_lop','ma_sach','ma_khoa_hoc'));
		
		
	}

	public function view_thong_ke_sach()
	{
		$array_khoa_hoc = KhoaHoc::all();

		$search = Request::get('search');
		$ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$start = Request::get('start');
		$end = Request::get('end');

		$array_thong_ke_sach = DB::table('sach')
								->select(DB::raw('
									*,
									if(a.so_luong_da_phat is null,0,a.so_luong_da_phat) as so_luong_da_phat,
									if(so_luong_nhap-so_luong_da_phat is null,so_luong_nhap,so_luong_nhap-so_luong_da_phat) as so_luong_ton_kho,
									ngay_nhap_sach'))
								->leftJoin(DB::raw('(select ma_sach,count(*) as so_luong_da_phat from dang_ky_sach where tinh_trang_nhan_sach = 1  group by ma_sach)a'),'a.ma_sach','=','sach.ma_sach')
								->join('khoa_hoc','sach.ma_khoa_hoc','=','khoa_hoc.ma_khoa_hoc');	
		if(isset($start)){
			$array_thong_ke_sach = $array_thong_ke_sach->where('ngay_nhap_sach','>=',$start);
		}
		if(isset($end)){
			$array_thong_ke_sach = $array_thong_ke_sach->where('ngay_nhap_sach','<=',$end);
		}
		if(isset($search)){
			$array_thong_ke_sach = $array_thong_ke_sach->where('ten_sach','like', '%'.$search.'%');
		}
		if(!empty($ma_khoa_hoc)){
			$array_thong_ke_sach = $array_thong_ke_sach->where('sach.ma_khoa_hoc','=', $ma_khoa_hoc);
		}
		
		$array_thong_ke_sach = $array_thong_ke_sach->orderBy('sach.ngay_nhap_sach','desc')->paginate(5);

		$array_thong_ke_sach->appends(array(
			'search' => Input::get('search'),
			'ma_khoa_hoc' => Input::get('ma_khoa_hoc'),
			'start' => Input::get('start'),
			'end' => Input::get('end')
		));
		if(!empty($start) && !empty($end) && $start > $end){
			$message = 'Bạn phải nhập ngày bắt đầu nhỏ hơn ngày kết thúc !';
				return view("$this->folder.view_thong_ke_sach",
				compact('message','array_thong_ke_sach','search','start','end')
			);
		}
		if(count($array_thong_ke_sach) == 0){
			$message = 'Không tìm thấy kết quả';
			return view("$this->folder.view_thong_ke_sach",compact('message','array_thong_ke_sach','array_khoa_hoc','search','ma_khoa_hoc','start','end'));
		}
		// dd(count($array_thong_ke_sach));
		return view("$this->folder.view_thong_ke_sach",compact('array_thong_ke_sach','array_khoa_hoc','search','ma_khoa_hoc','start','end'));
	}

	public function view_thong_ke_sach_chi_tiet()
	{
		$ma_sach = Request::get('ma_sach');
		$ma_lop = Request::get('ma_lop');

		$array_thong_ke_sach = DangKySach::query()
			->join('sinh_vien','dang_ky_sach.ma_sinh_vien','=','sinh_vien.ma_sinh_vien')	
			->join('lop','sinh_vien.ma_lop','=','lop.ma_lop')
			->join('sach','dang_ky_sach.ma_sach','=','sach.ma_sach')
			->where('dang_ky_sach.ma_sach', '=', $ma_sach)	
			->where('tinh_trang_nhan_sach', '=', 1);
		if(isset($ma_lop)){
			$array_thong_ke_sach = $array_thong_ke_sach->where('lop.ma_lop', '=', $ma_lop);
		}
		
		$array_thong_ke_sach = $array_thong_ke_sach->orderBy('lop.ma_lop')->paginate(8);

		$array_thong_ke_sach->appends(array('ma_sach' => Request::get('ma_sach'),'ma_lop' => Request::get('ma_lop')));

		$array_lop = DB::select(DB::raw("select lop.ma_lop, ten_lop from dang_ky_sach left join sinh_vien on dang_ky_sach.ma_sinh_vien = sinh_vien.ma_sinh_vien RIGHT JOIN lop on sinh_vien.ma_lop = lop.ma_lop where dang_ky_sach.ma_sach = '$ma_sach' and dang_ky_sach.tinh_trang_nhan_sach = 1 group by lop.ma_lop, ten_lop"));

		return view("$this->folder.view_thong_ke_sach_chi_tiet",compact('array_thong_ke_sach','array_lop','ma_lop','ma_sach')); 
	}

	public function export_thong_ke_sach()
	{
		return Excel::download(new ThongKeSachExport, 'thong_ke_sach.xlsx');
	}

	public function export_thong_ke_sinh_vien()
	{
		return Excel::download(new ThongKeSinhVienExport, 'thong_ke_sinh_vien.xlsx');
	}

	public function export_pdf_thong_ke_sach()
	{
		$search = Request::get('search');
		$ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$start = Request::get('start');
		$end = Request::get('end');

		$array_thong_ke_sach = DB::table('sach')
								->select(DB::raw('
									*,
									if(a.so_luong_da_phat is null,0,a.so_luong_da_phat) as so_luong_da_phat,
									if(so_luong_nhap-so_luong_da_phat is null,so_luong_nhap,so_luong_nhap-so_luong_da_phat) as so_luong_ton_kho,
									ngay_nhap_sach'))
								->leftJoin(DB::raw('(select ma_sach,count(*) as so_luong_da_phat from dang_ky_sach where tinh_trang_nhan_sach = 1  group by ma_sach)a'),'a.ma_sach','=','sach.ma_sach')
								->join('khoa_hoc','sach.ma_khoa_hoc','=','khoa_hoc.ma_khoa_hoc');	
		if(isset($start)){
			$array_thong_ke_sach = $array_thong_ke_sach->where('ngay_nhap_sach','>=',$start);
		}
		if(isset($end)){
			$array_thong_ke_sach = $array_thong_ke_sach->where('ngay_nhap_sach','<=',$end);
		}
		if(isset($search)){
			$array_thong_ke_sach = $array_thong_ke_sach->where('ten_sach','like', '%'.$search.'%');
		}
		if(!empty($ma_khoa_hoc)){
			$array_thong_ke_sach = $array_thong_ke_sach->where('sach.ma_khoa_hoc','=', $ma_khoa_hoc);
		}
		$array_thong_ke_sach = $array_thong_ke_sach->orderBy('sach.ngay_nhap_sach','desc')->get();
		
		$pdf = PDF::loadView("$this->folder.view_pdf_thong_ke_sach", ['array_thong_ke_sach' => $array_thong_ke_sach,'search' => $search,'start' => $start,'end' => $end]);
		return $pdf->download('danh_sach_cac_dau_sach.pdf');

	}

	public function export_pdf_thong_ke_sinh_vien()
	{
		$ma_lop = Request::get('ma_lop');
		$ma_sach = Request::get('ma_sach');

		$array_not_in = SinhVien::query()
			->join('dang_ky_sach','sinh_vien.ma_sinh_vien','=','dang_ky_sach.ma_sinh_vien')
			->where('ma_lop','=',$ma_lop)
			->where('dang_ky_sach.ma_sach','=',$ma_sach)->get(['sinh_vien.ma_sinh_vien']);

		$array_thong_ke_sinh_vien = DB::table('sinh_vien')
			->select(DB::raw('*'))
			->join('lop','sinh_vien.ma_lop','=','lop.ma_lop')
			->whereNotIn('sinh_vien.ma_sinh_vien',$array_not_in)
			->where('sinh_vien.ma_lop','=',$ma_lop)
			->orderBy('ma_sinh_vien','desc')->get();

		$ten_sach = Sach::where('ma_sach','=', $ma_sach)->select('ten_sach')->get();

		$pdf = PDF::loadView("$this->folder.view_pdf_thong_ke_sinh_vien", ['array_thong_ke_sinh_vien' => $array_thong_ke_sinh_vien, 'ten_sach' => $ten_sach]);
		return $pdf->download('danh_sach_sinh_vien_chua_dang_ky.pdf');
	}
}