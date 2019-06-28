<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Lop extends Model
{
	public $table = 'lop';
	public $limit = 5;
	public $offset = 0;
	public function get_all_lop()
	{
		$array_lop= DB::select ("select * from $this->table join khoa_hoc on $this->table.ma_khoa_hoc = khoa_hoc.ma_khoa_hoc");
		return $array_lop;
	}

	public function get_all()
	{
		$array_lop= DB::select ("select * from $this->table join khoa_hoc on $this->table.ma_khoa_hoc = khoa_hoc.ma_khoa_hoc order by ma_lop desc limit $this->limit offset $this->offset");
		return $array_lop;
	}

	public function get_all_by_khoa_hoc()
	{
		$array_lop = DB::select("select * from $this->table where ma_khoa_hoc=?",[$this->ma_khoa_hoc]);
		return $array_lop;
	}

	public function insert()
	{
		DB::insert("insert into $this->table (ten_lop,ma_khoa_hoc)
    		values (?,?)",[$this->ten_lop,$this->ma_khoa_hoc]);
	}

	public function get_one()
	{
		$array_lop= DB::select ("select * from $this->table where ma_lop = ? limit 1", [$this->ma_lop]);
		return $array_lop[0];
	}

	public function updateLop()
	{
		DB::update("update $this->table 
			set 
			ten_lop = ?,
			ma_khoa_hoc = ?
			where ma_lop = ?",[
				$this->ten_lop,
				$this->ma_khoa_hoc,
				$this->ma_lop
		]);
	}

	public function danh_sach_lop()
	{
		$array_lop = DB::select("select * from $this->table where ma_lop = ?",[$this->ma_lop]);
		return $array_lop;
	}
	public function count()
	{
		$count = DB::select("select count(*)/$this->limit as count from $this->table");
		return $count[0]->count;
	}
}