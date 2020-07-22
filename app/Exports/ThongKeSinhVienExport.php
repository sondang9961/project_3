<?php

namespace App\Exports;

use App\ThongKe;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Request;
use App\Model\SinhVien;
use App\Model\Sach;
use DB;

class ThongKeSinhVienExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
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

        return view('thong_ke.view_export_thong_ke_sinh_vien', ['array_thong_ke_sinh_vien' => $array_thong_ke_sinh_vien,
        	'ten_sach' => $ten_sach]);
    }
}
