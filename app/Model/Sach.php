<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Sach extends Model
{
	public $table = 'sach';
	public function get_all()
	{
		$array_sach= DB::select ("select * from $this->table join mon_hoc on $this->table.ma_mon_hoc = mon_hoc.ma_mon_hoc order by ma_sach desc");
		return $array_sach;
	}

	public function get_all_by_mon_hoc()
	{
		$array_sach = DB::select("select * from $this->table where ma_mon_hoc=?",[$this->ma_mon_hoc]);
		return $array_sach;
	}

	public function insert()
	{
		DB::insert("insert into sach (ten_sach,so_luong_nhap,ngay_nhap_sach,ngay_het_han,ma_mon_hoc) values (?,?,?,?,?)",[
			$this->ten_sach,
			$this->so_luong_nhap,
			$this->ngay_nhap_sach,
			$this->ngay_het_han,
			$this->ma_mon_hoc
			
		]);
	}
}