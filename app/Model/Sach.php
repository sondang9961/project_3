<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Sach extends Model
{
	public $table = 'sach';
	public function get_all()
	{
		$array_sach= DB::select ("select * from $this->table join mon_hoc on $this->table.ma_mon_hoc = mon_hoc.ma_mon_hoc");
		return $array_sach;
	}

	public function insert()
	{
		DB::insert("insert into sach (ten_sach,so_luong_nhap) values (?,?)",[$this->ten_sach,$this->so_luong_nhap]);
	}
}