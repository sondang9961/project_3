<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Lop extends Model
{
	static function get_all_lop()
	{
		$array_lop= DB::select ("select * from lop join khoa_hoc on lop.ma_khoa_hoc = khoa_hoc.ma_khoa_hoc");
		return $array_lop;
	}
}