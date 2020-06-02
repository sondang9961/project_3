<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class MonHoc extends Model
{
	public $table = 'mon_hoc';

	public static function get_all_by_khoa_hoc($ma_khoa_hoc)
	{
		return self::query()->where('ma_khoa_hoc','=',$ma_khoa_hoc)->get();
	}

}