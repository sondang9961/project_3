<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class ThongKe extends Model
{
	public function thong_ke_sinh_vien()
	{
		$array_thong_ke_sinh_vien= DB::select ("
			select ma_sinh_vien,ten_sinh_vien,lop.ma_lop,ten_lop FROM sinh_vien 
				join lop on sinh_vien.ma_lop = lop.ma_lop 
				where ma_sinh_vien not in(
				    select sinh_vien.ma_sinh_vien from sinh_vien 
				    join dang_ky_sach on dang_ky_sach.ma_sinh_vien = sinh_vien.ma_sinh_vien 
				    and ma_lop = ? and ma_sach = ? 
				) 
				and sinh_vien.ma_lop = ?",[
					$this->ma_lop,
					$this->ma_sach,
					$this->ma_lop
				]);
		return $array_thong_ke_sinh_vien;
	}

	public function thong_ke_sach()
	{
		$array_thong_ke_sach=DB::select(
			"select 
				ten_sach, 
				so_luong_nhap, 
				(select count(*) as so_luong_da_phat from dang_ky_sach where tinh_trang_nhan_sach = 1 and ma_sach = ?) as so_luong_da_phat, 
				(so_luong_nhap-(select count(*) as so_luong_da_phat 
			from dang_ky_sach where tinh_trang_nhan_sach = 1 and ma_sach = ?)) as so_luong_ton_kho, ngay_nhap_sach from sach where ma_sach = ? or ngay_nhap_sach = ?",[
					$this->ma_sach,
					$this->ma_sach,
					$this->ma_sach,
					$this->ngay_nhap_sach
			]);
		return $array_thong_ke_sach;
	}
}