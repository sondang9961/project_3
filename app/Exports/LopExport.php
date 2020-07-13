<?php

namespace App\Exports;

use App\Model\Lop;
use App\Model\SinhVien;
use Sofa\Eloquence\Subquery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LopExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
    	$countSinhVien = new \Sofa\Eloquence\Subquery(
		    SinhVien::from('sinh_vien')
		        ->selectRaw('count(*)')->whereRaw('ma_lop = lop.ma_lop'), 
		    'sy_so'
		);

		$array_lop = Lop::from('lop')
				        ->select('*', $countSinhVien)
				        ->addBinding($countSinhVien->getBindings(), 'select')
				        ->join('khoa_hoc','lop.ma_khoa_hoc','=','khoa_hoc.ma_khoa_hoc')
				        ->join('chuyen_nganh','lop.ma_chuyen_nganh','=','chuyen_nganh.ma_chuyen_nganh')
				        ->get();
        
        return view('lop.view_export', ['array_lop' => $array_lop]);
    }
}
