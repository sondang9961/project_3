<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Mon_hoc extends Model
{
	static function get_all_mon_hoc()
	{
		$array_mon_hoc= DB::select ("select * from mon_hoc join khoa_hoc on mon_hoc.ma_khoa_hoc = khoa_hoc.ma_khoa_hoc");
		return $array_mon_hoc;
	}
}