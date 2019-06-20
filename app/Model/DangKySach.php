<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class DangKySach extends Model
{
	public $table = 'dang_ky_sach';
	public function get_all()
	{
		$array_dang_ky_sach= DB::select ("select * from $this->table join sinh_vien on $this->table.ma_sinh_vien = sinh_vien.ma_sinh_vien JOIN sach on $this->table.ma_sach = sach.ma_sach");
		return $array_dang_ky_sach;
	}
}