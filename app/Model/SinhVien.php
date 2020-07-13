<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;


class SinhVien extends Model
{
	public $table = 'sinh_vien';
	protected $primaryKey = 'ma_sinh_vien';
	protected $fillable = ['ten_sinh_vien', 'ngay_sinh', 'email', 'sdt', 'dia_chi','ma_lop'];

	public static function get_sinh_vien_by_lop($ma_lop)
	{
		return self::query()->where('ma_lop','=',$ma_lop)->get();
	}

}