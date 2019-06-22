<?php

namespace App\Model;

use DB;

class DangKySach
{
	public $table = 'dang_ky_sach';
	public function get_all()
	{
		$array_dang_ky_sach= DB::select ("select * from $this->table join sinh_vien on $this->table.ma_sinh_vien = sinh_vien.ma_sinh_vien JOIN sach on $this->table.ma_sach = sach.ma_sach");
		return $array_dang_ky_sach;
	}
	public function updateTinhTrang()
	{
		DB::update("update $this->table
			set tinh_trang_nhan_sach = ?
			where ma_dang_ky = ?",[
				$this->tinh_trang_nhan_sach,
				$this->ma_dang_ky
			]);
	}
	public function getTenTinhTrangFromMaDangKy()
	{
		$array = DB::select ("select tinh_trang_nhan_sach from $this->table where ma_dang_ky = ? limit 1",[ 
			$this->ma_dang_ky
		]);
		return $array[0];
	}
}