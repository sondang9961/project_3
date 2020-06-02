<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;


class SinhVien extends Model
{
	public $table = 'sinh_vien';

	public static function get_all_by_lop($ma_lop)
	{
		return self::query()->where('ma_lop','=',$ma_lop)->get();
	}

}