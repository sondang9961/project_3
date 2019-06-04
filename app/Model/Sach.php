<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Sach extends Model
{
	static function get_all_sach()
	{
		$array_sach= DB::select ("select * from sach join mon_hoc on sach.ma_mon_hoc = mon_hoc.ma_mon_hoc");
		return $array_sach;
	}
}