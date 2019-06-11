<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class MonHoc extends Model
{
	public $table = 'mon_hoc';
	public function get_all()
	{
		$array_mon_hoc= DB::select ("select * from $this->table join khoa_hoc on $this->table.ma_khoa_hoc = khoa_hoc.ma_khoa_hoc");
		return $array_mon_hoc;
	}

	public function insert()
	{
		DB::insert("insert into $this->table (ten_mon_hoc,ma_khoa_hoc) values (?,?)",[$this->ten_mon_hoc,$this->ma_khoa_hoc]);
	}
}