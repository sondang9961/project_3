<?php
namespace App\Http\Controllers;

use Request;
use App\Model\SinhVien;

class SinhVienController extends Controller
{
	public function view_all()
	{
		$array_sinh_vien = SinhVien::get_all();
		return view ('sinh_vien.view_all',['array_sinh_vien' => $array_sinh_vien]);
	}
}