<?php

namespace App\Exports;

use App\ThongKe;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Request;
use DB;

class ThongKeSachExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
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
		if(!empty($search)){
			$array_thong_ke_sach = $array_thong_ke_sach->Where('ten_sach','like', '%'.$search.'%');
		}
		if(!empty($start)){
			$array_thong_ke_sach = $array_thong_ke_sach->where('ngay_nhap_sach','>=',$start);
		}
		if(!empty($end)){
			$array_thong_ke_sach = $array_thong_ke_sach->where('ngay_nhap_sach','<=',$end);
		}
		if(!empty($ma_khoa_hoc)){
			$array_thong_ke_sach = $array_thong_ke_sach->where('sach.ma_khoa_hoc','=', $ma_khoa_hoc);
		}
		
		$array_thong_ke_sach = $array_thong_ke_sach->orderBy('sach.ngay_nhap_sach','desc')->get();

		return view('thong_ke.view_export_thong_ke_sach', [
			'array_thong_ke_sach' => $array_thong_ke_sach,
			'search' => $search,
			'start' => $start,
			'end' => $end
		]);
    }
}
