<?php

namespace App\Exports;

use App\Model\MonHoc;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MonHocExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
    	$array_mon_hoc = MonHoc::query()->join('chuyen_nganh','mon_hoc.ma_chuyen_nganh','=','chuyen_nganh.ma_chuyen_nganh')->get();
        
        return view('mon_hoc.view_export', ['array_mon_hoc' => $array_mon_hoc]);
    }
}
