<?php

namespace App\Exports;

use App\Model\DangKySach;
use Sofa\Eloquence\Subquery;
use Illuminate\Database\Eloquent\Builder;
use App\Helper;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Request;

class DangKySachExport implements FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
	protected $ma_lop, $ma_sach;

	public function __construct($ma_lop,$ma_sach)
	{
		$this->ma_lop = $ma_lop;
		$this->ma_sach = $ma_sach;
	}

    public function query()
    {
        return DangKySach::query()
						->join('sinh_vien','dang_ky_sach.ma_sinh_vien','=','sinh_vien.ma_sinh_vien')
						->join('sach','dang_ky_sach.ma_sach','=','sach.ma_sach')
						->join('lop','sinh_vien.ma_lop','=','lop.ma_lop')
						->join('chuyen_nganh','lop.ma_chuyen_nganh','=','chuyen_nganh.ma_chuyen_nganh')
						->where('lop.ma_lop','=',$ma_lop)
						->where('sach.ma_sach','=',$ma_sach)
						->get();

    }
}
