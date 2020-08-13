<?php

namespace App\Exports;

use App\Model\SinhVien;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Request;

class SinhVienExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
    	$search = Request::get('search');

		$array_sinh_vien = SinhVien::query()->join('lop','sinh_vien.ma_lop','=','lop.ma_lop');
		if(isset($search)){
			$array_sinh_vien = $array_sinh_vien->where('ten_sinh_vien','LIKE','%'.$search.'%')
				->orWhere('ten_lop','LIKE','%'.$search.'%');
		}
		$array_sinh_vien = $array_sinh_vien->orderBy('ma_sinh_vien','desc')->get();

        return view('sinh_vien.view_export', ['array_sinh_vien' => $array_sinh_vien]);
    }
}
