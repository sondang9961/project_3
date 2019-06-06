<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class ThongKe extends Model
{
	static function get_all()
	{
		$array_thong_ke= DB::select ("select 
				ma_dang_ky,
				ten_sinh_vien,
				ten_sach,
				tinh_trang_nhan_sach,
				ngay_dang_ky,
				ngay_nhan_sach
			from dang_ky_sach 
			join sach on dang_ky_sach.ma_sach = sach.ma_sach 
			join sinh_vien on dang_ky_sach.ma_sinh_vien = sinh_vien.ma_sinh_vien
			join lop on sinh_vien.ma_lop = lop.ma_lop ");
		return $array_thong_ke;
	}
}