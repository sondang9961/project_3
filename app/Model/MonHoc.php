<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class MonHoc extends Model
{
	public $table = 'mon_hoc';
	public function get_all()
	{
		$array_mon_hoc= DB::select ("select * from $this->table join khoa_hoc on $this->table.ma_khoa_hoc = khoa_hoc.ma_khoa_hoc order by ma_mon_hoc desc");
		return $array_mon_hoc;
	}

	public function get_all_by_khoa_hoc($value='')
	{
		$array_mon_hoc = DB::select("select * from $this->table where ma_khoa_hoc=?",[$this->ma_khoa_hoc]);
		return $array_mon_hoc;
	}

	public function insert()
	{
		DB::insert("insert into $this->table (ten_mon_hoc,ma_khoa_hoc) values (?,?)",[$this->ten_mon_hoc,$this->ma_khoa_hoc]);
	}

	public function get_one()
	{
		$array_mon_hoc= DB::select ("select * from $this->table where ma_mon_hoc = ? limit 1", [$this->ma_mon_hoc]);
		return $array_mon_hoc[0];
	}

	public function updateMonHoc()
	{
		DB::update("update $this->table 
			set 
			ten_mon_hoc = ?, 
			ma_khoa_hoc = ? 
			where ma_mon_hoc = ?",[
				$this->ten_mon_hoc,
				$this->ma_khoa_hoc,
				$this->ma_mon_hoc
			]);
	}
}