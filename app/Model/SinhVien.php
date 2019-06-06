<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class SinhVien extends Model
{
	static function get_all()
	{
		$array_sach= DB::select ("select * from sinh_vien join lop on sinh_vien.ma_lop = lop.ma_lop");
		return $array_sach;
	}
}