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
		$dieu_kien = "where 1 = 1 ";
			if($this->ma_khoa_hoc!='ma_khoa_hoc'){
					$dieu_kien = $dieu_kien." and ma_khoa_hoc = $this->ma_khoa_hoc";
				}
			if($this->ma_lop!='ma_lop'){
					$dieu_kien = $dieu_kien." and lop.ma_lop = $this->ma_lop";
				}
			if($this->ma_mon_hoc!='ma_mon_hoc'){
					$dieu_kien = $dieu_kien." and ma_mon_hoc = $this->ma_mon_hoc";
				}
			if($this->ma_sach!='ma_sach'){
					$dieu_kien = $dieu_kien." and sach.ma_sach = $this->ma_sach";
				}
		$array_dang_ky_sach= DB::select ("
			select ma_dang_ky, ten_sinh_vien,ten_lop, tinh_trang_nhan_sach, ten_sach,ngay_nhap_sach, ngay_dang_ky, ngay_nhan_sach from $this->table 
				join sinh_vien on dang_ky_sach.ma_sinh_vien = sinh_vien.ma_sinh_vien 
				JOIN sach on dang_ky_sach.ma_sach = sach.ma_sach
				join lop on sinh_vien.ma_lop = lop.ma_lop
			$dieu_kien
			order by ma_dang_ky desc limit $this->limit offset $this->offset");
		return $array_dang_ky_sach;
	}

	public function count()
	{
		$dieu_kien = "where 1 = 1 ";
			if($this->ma_khoa_hoc!='ma_khoa_hoc'){
					$dieu_kien = $dieu_kien." and ma_khoa_hoc = $this->ma_khoa_hoc";
				}
			if($this->ma_lop!='ma_lop'){
					$dieu_kien = $dieu_kien." and lop.ma_lop = $this->ma_lop";
				}
			if($this->ma_mon_hoc!='ma_mon_hoc'){
					$dieu_kien = $dieu_kien." and ma_mon_hoc = $this->ma_mon_hoc";
				}
			if($this->ma_sach!='ma_sach'){
					$dieu_kien = $dieu_kien." and sach.ma_sach = $this->ma_sach";
				}
		$count = DB::select("
			select count(*)/$this->limit as count from (
				select ma_dang_ky, ten_sinh_vien,ten_lop, tinh_trang_nhan_sach, ten_sach,ngay_nhap_sach, ngay_dang_ky, ngay_nhan_sach from $this->table 
					join sinh_vien on dang_ky_sach.ma_sinh_vien = sinh_vien.ma_sinh_vien 
					JOIN sach on dang_ky_sach.ma_sach = sach.ma_sach
					join lop on sinh_vien.ma_lop = lop.ma_lop
				$dieu_kien
				order by ma_dang_ky desc
			)a");
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

	public function check_so_luong()
	{
		$array_check_so_luong = DB::select("select so_luong_nhap - (SELECT COUNT(*) FROM sach join $this->table on sach.ma_sach = $this->table.ma_sach WHERE tinh_trang_nhan_sach = 1 and sach.ma_sach = ?) as so_luong_ton_kho from sach where ma_sach = ?",[
			$this->ma_sach,
			$this->ma_sach
		]);
		return $array_check_so_luong;
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

	public function get_all_by_mon_hoc_1()//còn hạn
	{
		$array_sach = DB::select("select * from sach where ma_mon_hoc = ? and CURRENT_DATE - ngay_het_han <= 0 order by ngay_nhap_sach desc",[$this->ma_mon_hoc]);
		return $array_sach;
	}
}