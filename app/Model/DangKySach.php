<?php

namespace App\Model;

use DB;

class DangKySach
{
	public $table = 'dang_ky_sach';
	public $limit = 5;
	public $offset = 0;
	public $ngay_nhan_sach = null;
	public function get_all()
	{
		$array_dang_ky_sach= DB::select ("
			select ma_dang_ky, ten_sinh_vien, tinh_trang_nhan_sach, ten_sach, ngay_dang_ky, ngay_nhan_sach from dang_ky_sach 
				join sinh_vien on dang_ky_sach.ma_sinh_vien = sinh_vien.ma_sinh_vien 
				JOIN sach on dang_ky_sach.ma_sach = sach.ma_sach
				join lop on sinh_vien.ma_lop = lop.ma_lop
			where (? is null and ? is null or sach.ma_sach = ? and lop.ma_lop = ?)
			order by ma_dang_ky desc limit $this->limit offset $this->offset",[
				$this->ma_sach,
				$this->ma_lop,
				$this->ma_sach,
				$this->ma_lop
			]);
		return $array_dang_ky_sach;
	}

	public function count()
	{
		$count = DB::select("
			select count(*)/$this->limit as count from $this->table
				join sinh_vien on dang_ky_sach.ma_sinh_vien = sinh_vien.ma_sinh_vien 
				JOIN sach on dang_ky_sach.ma_sach = sach.ma_sach
			where (? is null and ? is null or sach.ma_sach = ? and ma_lop = ?)",[
				$this->ma_sach,
				$this->ma_lop,
				$this->ma_sach,
				$this->ma_lop
			]);
		return $count[0]->count;
	}

	public function updateTinhTrang()
	{
		DB::update("update $this->table
			set 
			tinh_trang_nhan_sach = ?,
			ngay_nhan_sach = ?
			where ma_dang_ky = ?",[
				$this->tinh_trang_nhan_sach,
				$this->ngay_nhan_sach,
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

	public function check_insert()
	{
		$array_dang_ky_sach = DB::select("select * from $this->table where ma_sinh_vien = ? and ma_sach = ? limit 1",[
			$this->ma_sinh_vien,
			$this->ma_sach
		]);
		return $array_dang_ky_sach;
	}

	public function insert()
	{
		DB::insert("insert into $this->table (ma_sinh_vien, ma_sach, tinh_trang_nhan_sach, ngay_dang_ky, ngay_nhan_sach) values (?, ?, ?, ?, ?)",[
				$this->ma_sinh_vien,
				$this->ma_sach,
				$this->tinh_trang_nhan_sach,
				$this->ngay_dang_ky,		
				$this->ngay_nhan_sach
		]);
	}
}