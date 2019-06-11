<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Lop extends Model
{
	public $table = 'lop';
	public function get_all()
	{
		$array_lop= DB::select ("select * from $this->table join khoa_hoc on $this->table.ma_khoa_hoc = khoa_hoc.ma_khoa_hoc");
		return $array_lop;
	}

	public function insert()
	{
		DB::insert("insert into $this->table (ten_lop,ma_khoa_hoc)
    		values (?,?)",[$this->ten_lop,$this->ma_khoa_hoc]);
	}
}