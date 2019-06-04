<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Dang_ky_sach extends Model
{
	static function get_all_dang_ky_sach()
	{
		$array_dang_ky_sach= DB::select ("select ma_dang_ky,ten_sinh_vien,ten_sach,tinh_trang_nhan_sach,ngay_dang_ky,ngay_nhan_sach from dang_ky_sach join sach on dang_ky_sach.ma_sach = sach.ma_sach join sinh_vien on dang_ky_sach.ma_sinh_vien = sinh_vien.ma_sinh_vien");
		return $array_dang_ky_sach;
	}
}