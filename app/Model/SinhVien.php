<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;


class SinhVien extends Model
{
	public $table = 'sinh_vien';
	public $limit = 5;
	public $offset = 0;
	public function get_all_sinh_vien()
		{
			$array_lop= DB::select ("select * from $this->table join lop on $this->table.ma_lop = lop.ma_lop");
			return $array_sinh_vien;
		}

	public function get_all()
	{
		$array_sinh_vien= DB::select ("
			select * from $this->table join lop on $this->table.ma_lop = lop.ma_lop
			where (? is null or $this->table.ma_lop = ?)
			order by ma_sinh_vien desc limit $this->limit offset $this->offset",[
				$this->ma_lop,
				$this->ma_lop
			]);
		return $array_sinh_vien;
	}

	public function count()
	{
		$count = DB::select("select count(*)/$this->limit as count from $this->table
			where (? is null or $this->table.ma_lop = ?)",[
				$this->ma_lop,
				$this->ma_lop
			]);
		return $count[0]->count;
	}

	public function get_all_by_lop()
	{
		$array_sinh_vien = DB::select("select * from $this->table where ma_lop=?",[$this->ma_lop]);
		return $array_sinh_vien;
	}

	public function insert()
	{
		DB::insert("insert into $this->table (ten_sinh_vien,ma_lop)
    		values (?,?)",[$this->ten_sinh_vien,$this->ma_lop]);
	}

	public function get_one()
	{
		$array_sinh_vien= DB::select ("select * from $this->table join lop on $this->table.ma_lop = lop.ma_lop where ma_sinh_vien = ? limit 1", [$this->ma_sinh_vien]);
		return $array_sinh_vien[0];
	}

	public function updateSinhVien()
	{
		DB::update("update $this->table 
			set
			ten_sinh_vien = ?,
			ma_lop = ? 
			where ma_sinh_vien = ?",[
				$this->ten_sinh_vien,
				$this->ma_lop,
				$this->ma_sinh_vien
			]);
	}

	public function danh_sach_sinh_vien_by_lop()
	{
		$array_sinh_vien_by_lop= DB::select ("select ma_sinh_vien, ten_sinh_vien, ten_lop, (select count(*) from $this->table where ma_lop = ?) as sy_so from $this->table join lop on $this->table.ma_lop = lop.ma_lop where $this->table.ma_lop = ? ORDER by ma_sinh_vien desc limit $this->limit offset $this->offset",[
				$this->ma_lop,
				$this->ma_lop
			]);
		return $array_sinh_vien_by_lop;
	}

	public function count_sinh_vien_by_lop()
	{
		$count_sinh_vien_by_lop = DB::select("select count(*)/$this->limit as count_sinh_vien_by_lop from $this->table where ma_lop = ?",[$this->ma_lop,]);
		return $count_sinh_vien_by_lop[0]->count_sinh_vien_by_lop;
	}
}