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

	public function get_all_by_lop($value='')
	{
		$array_sinh_vien = DB::select("select * from $this->table where ma_lop=?",[$this->ma_lop]);
		return $array_sinh_vien;
	}

	public function updateSV()
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
		$array_sinh_vien= DB::select ("select * from $this->table join lop on $this->table.ma_lop = lop.ma_lop where sinh_vien.ma_lop = ?",[$this->ma_lop]);
		return $array_sinh_vien;
	}
}