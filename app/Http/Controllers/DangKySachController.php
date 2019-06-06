<?php
namespace App\Http\Controllers;

use Request;
use App\Model\DangKySach;

class DangKySachController extends Controller
{
	public function view_all()
	{
		$array_dang_ky_sach = DangKySach::get_all();
		return view ('dang_ky_sach.view_all',['array_dang_ky_sach' => $array_dang_ky_sach]);
	}
}