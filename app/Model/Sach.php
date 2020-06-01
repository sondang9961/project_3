<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Sach extends Model
{
	public $table = 'sach';

	public function get_all_by_mon_hoc()
	{
		$array_sach = DB::select("select * from $this->table where ma_mon_hoc = ? order by ngay_nhap_sach desc",[$this->ma_mon_hoc]);
		return $array_sach;
	}

	// public function get_all_by_mon_hoc_and_han_dang_ky()//hết hạn
	// {
	// 	$array_sach = DB::select("select * from $this->table where ma_mon_hoc = ? and CURRENT_DATE - ngay_het_han > 0",[$this->ma_mon_hoc]);
	// 	return $array_sach;
	// }

	public function get_all_by_lop()
	{
		$array_sach = DB::select("
			select lop.ma_lop, ten_lop, $this->table.ma_sach,ten_sach,ngay_nhap_sach from lop join 
				khoa_hoc on lop.ma_khoa_hoc=khoa_hoc.ma_khoa_hoc join 
				mon_hoc on khoa_hoc.ma_khoa_hoc = mon_hoc.ma_khoa_hoc join 
				$this->table on mon_hoc.ma_mon_hoc = $this->table.ma_mon_hoc where ma_lop = ?",[
					$this->ma_lop
				]
		);
		return $array_sach;
	}

}