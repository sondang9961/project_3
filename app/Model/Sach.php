<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Sach extends Model
{
	public $table = 'sach';

	public static function get_all_by_chuyen_nganh($ma_chuyen_nganh)
	{
		//còn hạn
		return self::query()->join('khoa_hoc','sach.ma_khoa_hoc','=','khoa_hoc.ma_khoa_hoc')
							->where('mon_hoc.ma_chuyen_nganh','=',$ma_chuyen_nganh)
							->whereRaw("CURRENT_DATE - ngay_het_han <= 0 ")->orderBy('ngay_nhap_sach','desc')->get();
		//hết hạn
		// return self::query()->join('mon_hoc','mon_hoc.ma_mon_hoc','=','sach.ma_mon_hoc')
		// 					->join('lop','mon_hoc.ma_chuyen_nganh','=','lop.ma_chuyen_nganh')
		// 					->where('lop.ma_lop','=',$ma_lop)
		// 					->orderBy('ngay_nhap_sach','desc')->get();
	}	

	public static function get_all_by_lop($ma_lop)
	{
		//còn hạn
		return self::query()->join('lop','sach.ma_khoa_hoc','=','lop.ma_khoa_hoc')
							->where('lop.ma_lop','=',$ma_lop)
							->orderBy('ngay_nhap_sach','desc')->get();
	}						
}