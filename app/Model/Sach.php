<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Sach extends Model
{
	public $table = 'sach';

	public static function get_all_by_mon_hoc($ma_mon_hoc)//còn hạn
	{
		return self::query()->where('ma_mon_hoc','=',$ma_mon_hoc)
							->whereRaw("CURRENT_DATE - ngay_het_han <= 0 ")->orderBy('ngay_nhap_sach','desc')->get();
	}

	public static function get_all_by_lop($ma_lop)
	{
		return self::query()->join('mon_hoc','mon_hoc.ma_mon_hoc','=','sach.ma_mon_hoc')
							->join('khoa_hoc','khoa_hoc.ma_khoa_hoc','=','mon_hoc.ma_khoa_hoc')
							->join('lop','lop.ma_khoa_hoc','=','khoa_hoc.ma_khoa_hoc')
							->where('lop.ma_lop','=',$ma_lop)->get();
	}
}