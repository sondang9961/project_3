<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class MonHoc extends Model
{
	static function get_all()
	{
		$array_mon_hoc= DB::select ("select * from mon_hoc join khoa_hoc on mon_hoc.ma_khoa_hoc = khoa_hoc.ma_khoa_hoc");
		return $array_mon_hoc;
	}
}