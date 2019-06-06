<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class KhoaHoc extends Model
{
	static function get_all()
	{
		$array_khoa_hoc= DB::select ("select * from khoa_hoc");
		return $array_khoa_hoc;
	}
}