<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Khoa_hoc extends Model
{
	static function get_all_khoa_hoc()
	{
		$array_khoa_hoc= DB::select ("select * from khoa_hoc");
		return $array_khoa_hoc;
	}
}