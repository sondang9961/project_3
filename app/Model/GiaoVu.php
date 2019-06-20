<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use DB;

class GiaoVu extends Model
{
	public $table = 'giao_vu';
	public function check_login()
	{
		$array = DB::select("select * from $this->table where email = ? and password = ? limit 1",[
			$this->email,
			$this->password
		]);
		return $array;
	}
}