<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class KhoaHoc extends Model
{
	public $table = 'khoa_hoc';
	public $limit = 5;
	public $offset = 0;

	public function get_all_khoa_hoc(){
		$array_all_khoa_hoc= DB::select ("select * from $this->table order by ma_khoa_hoc desc");
		return $array_all_khoa_hoc;
	}

	public function get_all()
	{
		$array_khoa_hoc= DB::select ("select * from $this->table where (? is null or $this->table.ma_khoa_hoc = ?) order by ma_khoa_hoc desc limit $this->limit offset $this->offset",[
				$this->ma_khoa_hoc,
				$this->ma_khoa_hoc
			]);
		return $array_khoa_hoc;
	}

	public function count()
	{
		$count = DB::select("select count(*)/$this->limit as count from $this->table
			where (? is null or $this->table.ma_khoa_hoc = ?)",[
				$this->ma_khoa_hoc,
				$this->ma_khoa_hoc
			]);
		return $count[0]->count;
	}


	public function check_insert()
	{
		$array_lop = DB::select("select * from $this->table where ten_khoa_hoc = ? ",[
			$this->ten_khoa_hoc
		]);
		return $array_lop;
	}

	public function insert()
	{
		DB::insert("insert into $this->table(ten_khoa_hoc) values (?)", [$this->ten_khoa_hoc]);
	}

	public function get_one()
	{
		$array_khoa_hoc= DB::select ("select * from $this->table where ma_khoa_hoc = ? limit 1", [$this->ma_khoa_hoc]);
		return $array_khoa_hoc[0];
	}

	public function updateKhoaHoc()
	{
		DB::update("update $this->table set ten_khoa_hoc = ? where ma_khoa_hoc = ?",[$this->ten_khoa_hoc, $this->ma_khoa_hoc]);
	}
	
}