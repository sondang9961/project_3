<?php

namespace App\Exports;

use App\Model\MonHoc;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Request;

class MonHocExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
    	$search = Request::get('search');

    	$array_mon_hoc = MonHoc::query()->join('chuyen_nganh','mon_hoc.ma_chuyen_nganh','=','chuyen_nganh.ma_chuyen_nganh');
    	if(isset($search)){
    		$array_mon_hoc = $array_mon_hoc->where('ten_mon_hoc','LIKE','%'.$search.'%')
							->orWhere('ten_chuyen_nganh','LIKE','%'.$search.'%');
    	}
    	$array_mon_hoc = $array_mon_hoc->get();
        
        return view('mon_hoc.view_export', ['array_mon_hoc' => $array_mon_hoc, 'search' => $search]);
    }
}
