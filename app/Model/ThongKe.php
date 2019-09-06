<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Model\Sach;

class ThongKe extends Model
{
	public $limit = 7;
	public $offset = 0;

	public function thong_ke_sach()
		{
			// dd($this->ma_mon_hoc);
			$dieu_kien = "where 1 = 1 ";
			if($this->ma_mon_hoc!='ma_mon_hoc'){
					$dieu_kien = $dieu_kien." and ma_mon_hoc = $this->ma_mon_hoc";
				}
			if($this->ngay_nhap_sach!='ngay_nhap_sach'){
					$dieu_kien = $dieu_kien." and ngay_nhap_sach = '$this->ngay_nhap_sach'";
				}

			$query = DB::select(
				"	
					select 
				    sach.ma_sach,
					ten_sach, 
					so_luong_nhap,
					if(a.so_luong_da_phat is null,0,a.so_luong_da_phat) as so_luong_da_phat,
					if(so_luong_nhap-so_luong_da_phat is null,so_luong_nhap,so_luong_nhap-so_luong_da_phat) as so_luong_ton_kho,
					ngay_nhap_sach 
					from sach 
					left join 
					(select ma_sach,count(*) as so_luong_da_phat from dang_ky_sach where tinh_trang_nhan_sach = 1  group by ma_sach)a
					on a.ma_sach=sach.ma_sach $dieu_kien order by ma_sach desc limit $this->limit offset $this->offset
				");
						
				$array_thong_ke_sach = $query;
			return $array_thong_ke_sach;
		}
	public function count_sach()
	{
		$dieu_kien = "where 1 = 1 ";
			if($this->ma_mon_hoc!='ma_mon_hoc'){
					$dieu_kien = $dieu_kien." and ma_mon_hoc = $this->ma_mon_hoc";
				}
			if($this->ngay_nhap_sach!='ngay_nhap_sach'){
					$dieu_kien = $dieu_kien." and ngay_nhap_sach = '$this->ngay_nhap_sach'";
				}

		$count_sach=DB::select(
			"select COUNT(*)/$this->limit as count_sach FROM
				(
					select 
				    sach.ma_sach,
					ten_sach, 
					so_luong_nhap,
					if(a.so_luong_da_phat is null,0,a.so_luong_da_phat) as so_luong_da_phat,
					if(so_luong_nhap-so_luong_da_phat is null,so_luong_nhap,so_luong_nhap-so_luong_da_phat) as so_luong_ton_kho,
					ngay_nhap_sach 
					from sach 
					left join 
					(select ma_sach,count(*) as so_luong_da_phat from dang_ky_sach where tinh_trang_nhan_sach = 1  group by ma_sach)a
					on a.ma_sach=sach.ma_sach $dieu_kien order by ma_sach desc
				)b");
			return $count_sach[0]->count_sach;
	}

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
				and sinh_vien.ma_lop = ? order by ma_sinh_vien desc limit $this->limit offset $this->offset",[
					$this->ma_lop,
					$this->ma_sach,
					$this->ma_lop
				]);
		return $array_thong_ke_sinh_vien;
	}

	public function count_sinh_vien()
	{
		$count_sinh_vien= DB::select ("
			select count(*)/$this->limit as count_sinh_vien from 
			(
				select ma_sinh_vien,ten_sinh_vien,lop.ma_lop,ten_lop FROM sinh_vien 
					join lop on sinh_vien.ma_lop = lop.ma_lop 
					where ma_sinh_vien not in(
					    select sinh_vien.ma_sinh_vien from sinh_vien 
					    join dang_ky_sach on dang_ky_sach.ma_sinh_vien = sinh_vien.ma_sinh_vien 
					    and ma_lop = ? and ma_sach = ? 
					) 
					and sinh_vien.ma_lop = ? 
			)a",[
					$this->ma_lop,
					$this->ma_sach,
					$this->ma_lop
				]);
		return $count_sinh_vien[0]->count_sinh_vien;
	}
}