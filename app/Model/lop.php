<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Lop extends Model
{
	public $table = 'lop';

	public static function get_all_by_khoa_hoc($ma_khoa_hoc)
	{
		return self::query()->where('ma_khoa_hoc','=',$ma_khoa_hoc)->get();
	}
}