<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Sach extends Model
{
	public $table = 'sach';
	public $limit = 5;
	public $offset = 0;
	public function get_all()
	{
		$array_sach= DB::select ("
			select * from $this->table join mon_hoc on $this->table.ma_mon_hoc = mon_hoc.ma_mon_hoc 
			where (? is null or ? is null or $this->table.ma_mon_hoc = ? and ma_sach = ?)
			order by ma_sach desc limit $this->limit offset $this->offset",[
				$this->ma_mon_hoc,
				$this->ma_sach,
				$this->ma_mon_hoc,
				$this->ma_sach,
			]);
		return $array_sach;
	}

	public function count()
	{
		$count = DB::select("select count(*)/$this->limit as count from $this->table
			where (? is null and ? is null or $this->table.ma_mon_hoc = ? and ma_sach = ?)",[
				$this->ma_mon_hoc,
				$this->ma_sach,
				$this->ma_mon_hoc,
				$this->ma_sach,
			]);
		return $count[0]->count;
	}

	public function get_all_by_mon_hoc()
	{
		
		$array_sach = DB::select("select * from $this->table where ma_mon_hoc = ? order by ngay_nhap_sach desc",[$this->ma_mon_hoc]);
		return $array_sach;
	}

	// public function get_all_by_mon_hoc_and_han_dang_ky()//hết hạn
	// {
	// 	$array_sach = DB::select("select * from $this->table where ma_mon_hoc = ? and CURRENT_DATE - ngay_het_han > 0",[$this->ma_mon_hoc]);
	// 	return $array_sach;
	// }

	public function get_all_by_lop()
	{
		$array_sach = DB::select("
			select lop.ma_lop, ten_lop, $this->table.ma_sach,ten_sach,ngay_nhap_sach from lop join 
				khoa_hoc on lop.ma_khoa_hoc=khoa_hoc.ma_khoa_hoc join 
				mon_hoc on khoa_hoc.ma_khoa_hoc = mon_hoc.ma_khoa_hoc join 
				$this->table on mon_hoc.ma_mon_hoc = $this->table.ma_mon_hoc where ma_lop = ?",[
					$this->ma_lop
				]
		);
		return $array_sach;
	}

	public function check_insert()
	{
		$array_sach = DB::select("select * from $this->table where ten_sach = ? and ngay_nhap_sach = ?",[
			$this->ten_sach,
			$this->ngay_nhap_sach
		]);
		return $array_sach;
	}

	public function insert()
	{
		DB::insert("insert into $this->table (ten_sach,so_luong_nhap,ngay_nhap_sach,ngay_het_han,ma_mon_hoc) values (?,?,?,?,?)",[
			$this->ten_sach,
			$this->so_luong_nhap,
			$this->ngay_nhap_sach,
			$this->ngay_het_han,
			$this->ma_mon_hoc		
		]);
	}

	public function updateInsert()
	{
		DB::update("update $this->table set so_luong_nhap = so_luong_nhap + ?, ngay_nhap_sach = ?, ngay_het_han = ? where ten_sach = ?",[
				$this->so_luong_nhap,
				$this->ngay_nhap_sach,
				$this->ngay_het_han,
				$this->ten_sach,
		]);
	}

	public function updateSach()
	{
		DB::update("update $this->table set
			ten_sach = ?,
			so_luong_nhap = ?,
			ngay_nhap_sach = ?,
			ngay_het_han = ?,
			ma_mon_hoc = ?
			where ma_sach = ?",[
				$this->ten_sach,
				$this->so_luong_nhap,
				$this->ngay_nhap_sach,
				$this->ngay_het_han,
				$this->ma_mon_hoc,
				$this->ma_sach	
		]);
	}

	public function get_one()
	{
		$array_sach = DB::select ("select * from $this->table join mon_hoc on $this->table.ma_mon_hoc = mon_hoc.ma_mon_hoc where ma_sach = ? limit 1", [$this->ma_sach]);
		return $array_sach[0];
	}
}