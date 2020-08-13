<?php

namespace App\Exports;

use App\Model\DangKySach;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Request;

class DangKySachExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {
    	$ma_lop = Request::get('ma_lop');
    	$ma_sach = Request::get('ma_sach');

        $array_dang_ky_sach = DangKySach::query()
						->join('sinh_vien','dang_ky_sach.ma_sinh_vien','=','sinh_vien.ma_sinh_vien')
						->join('sach','dang_ky_sach.ma_sach','=','sach.ma_sach')
                        ->join('khoa_hoc','sach.ma_khoa_hoc','=','khoa_hoc.ma_khoa_hoc')
						->join('lop','sinh_vien.ma_lop','=','lop.ma_lop')
						->where('lop.ma_lop','=',$ma_lop)
						->where('sach.ma_sach','=',$ma_sach)
						->get();

		return view('dang_ky_sach.view_export', ['array_dang_ky_sach' => $array_dang_ky_sach]);				
    }
}
