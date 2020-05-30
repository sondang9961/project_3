<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Request;
use App\Model\ThongKe;
use App\Model\Lop;
use App\Model\Sach;
use App\Model\MonHoc;
use DB;

class ThongKeController extends Controller
{
	private $folder = 'thong_ke';

	public function view_thong_ke_sinh_vien()
	{
		$trang = Request::get('trang');

		if(empty($trang)){
			$trang = 1;
		}
		
		$limit = 5;

		$lop = new Lop();
		$array_lop = $lop->get_all_lop();

		$sach = new Sach();
		$array_sach = $sach->get_all();

		$thong_ke = new ThongKe();
		$thong_ke->offset = ($trang - 1)*$limit;
		$thong_ke->limit = $limit;
		$ma_lop = Request::get('ma_lop');
		$ma_sach = Request::get('ma_sach');
		$thong_ke->ma_lop = $ma_lop;
		$thong_ke->ma_sach = $ma_sach;
		$array_thong_ke_sinh_vien = $thong_ke->thong_ke_sinh_vien();
		$count_trang = ceil($thong_ke->count_sinh_vien());

		if ($trang > 1) $prev = $trang - 1; else $prev = 0;
		if ($trang < $count_trang) $next = $trang + 1; else $next = 0;
		if ($trang <= 3) $startpage = 1;
		else if ($trang == $count_trang) $startpage = $trang - 6;
		else if ($trang == $count_trang - 2) $startpage = $trang - 5;
		else if ($trang == $count_trang - 1) $startpage = $trang - 4;
		else $startpage = $trang - 3;
		$endpage = $startpage + 6;

		return view("$this->folder.view_thong_ke_sinh_vien",[
			'array_thong_ke_sinh_vien' => $array_thong_ke_sinh_vien,
			'array_lop' => $array_lop,
			'array_sach' => $array_sach,
			'count_trang' => $count_trang,
			'ma_lop' => $ma_lop,
			'ma_sach' => $ma_sach,
			'trang' => $trang,
			'thong_ke' => $thong_ke,
			'prev' => $prev,
			'next' => $next,
			'startpage' => $startpage,
			'endpage' => $endpage
		]);
	}

	public function view_thong_ke_sach()
	{
		$array_sach = Sach::all();

		$array_mon_hoc = MonHoc::all();

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
		if(!empty($start) && !empty($end)){
			$array_thong_ke_sach = $array_thong_ke_sach->where('ngay_nhap_sach','>=',$start)
													   ->where('ngay_nhap_sach','<=',$end);
		}
		$array_thong_ke_sach = $array_thong_ke_sach->orderBy('sach.ma_sach','desc')->paginate(5);

		$array_thong_ke_sach->appends(array(
			'search' => Input::get('search'),
			'start' => Input::get('start'),
			'end' => Input::get('end')
		));

		return view("$this->folder.view_thong_ke_sach",[
			'array_thong_ke_sach' => $array_thong_ke_sach,
			'array_sach' => $array_sach,
			'array_mon_hoc' => $array_mon_hoc,
		]);
	}

}