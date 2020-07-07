<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Lop extends Model
{
	public $table = 'lop';

	public static function get_all_by_chuyen_nganh($ma_chuyen_nganh)
	{
		return self::query()->where('ma_chuyen_nganh','=',$ma_chuyen_nganh)->get();
	}
}