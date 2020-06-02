<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Model\Sach;

class DangKySach extends Model
{
	public $table = 'dang_ky_sach';
	public $ngay_nhan_sach = null;

	public function updateTinhTrang()
	{
		DB::update("update $this->table set tinh_trang_nhan_sach = ?, ngay_nhan_sach = ? where ma_dang_ky = ?",[
				$this->tinh_trang_nhan_sach,
				$this->ngay_nhan_sach,
				$this->ma_dang_ky
			]);
	}

	public function check_so_luong()
	{
		$array_check_so_luong = DB::select("select so_luong_nhap - (SELECT COUNT(*) FROM sach join $this->table on sach.ma_sach = $this->table.ma_sach WHERE tinh_trang_nhan_sach = 1 and sach.ma_sach = ?) as so_luong_ton_kho from sach where ma_sach = ?",[
			$this->ma_sach,
			$this->ma_sach
		]);
		return $array_check_so_luong;
	}

}