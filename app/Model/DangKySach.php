<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class DangKySach extends Model
{
	static function get_all_dang_ky_sach()
	{
		$array_dang_ky_sach= DB::select ("
			select * from dang_ky_sach 
			");
		return $array_dang_ky_sach;
	}
}