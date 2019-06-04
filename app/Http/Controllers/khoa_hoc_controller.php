<?php
namespace App\Http\Controllers;

use Request;
use App\Model\Khoa_hoc;

class khoa_hoc_controller extends Controller
{
	public function view_quan_ly_khoa_hoc()
	{
		$array_khoa_hoc = Khoa_hoc::get_all_khoa_hoc();
		return view ('view_quan_ly_khoa_hoc',['array_khoa_hoc' => $array_khoa_hoc]);
	}
}