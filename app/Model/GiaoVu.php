<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use DB;

class GiaoVu extends Model
{
	public $table = 'giao_vu';
	public function check_login()
	{
		$array_giao_vu = DB::select("select * from $this->table where email = ? and password = ? limit 1",[
			$this->email,
			$this->password
		]);
		return $array_giao_vu;
	}

	public function get_one()
	{
		$array_giao_vu = DB::select("select * from $this->table where ma_giao_vu = ?",[$this->ma_giao_vu]);
		return $array_giao_vu;
	}

	public function update_profile()
	{
		DB::update("update $this->table 
			set
				ten_giao_vu = ?,
				email = ?,
				sdt = ?,
				dia_chi = ?
				where ma_giao_vu = ?",[
					$this->ten_giao_vu,
					$this->email,
					$this->sdt,
					$this->dia_chi,
					$this->ma_giao_vu
		]);
	}


}