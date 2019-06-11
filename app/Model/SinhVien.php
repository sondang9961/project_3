<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;


class SinhVien extends Model
{
	public $table = 'sinh_vien';
	public function get_all()
	{
		$array_sinh_vien= DB::select ("select * from $this->table join lop on $this->table.ma_lop = lop.ma_lop");
		return $array_sinh_vien;
	}

	public function insert()
	{
		DB::insert("insert into $this->table (ten_sinh_vien,ma_lop) values (?,?)",[$this->ten_sinh_vien,$this->ma_lop]);
	}
}