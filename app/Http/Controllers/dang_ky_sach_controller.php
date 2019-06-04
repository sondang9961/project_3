<?php
namespace App\Http\Controllers;

use Request;
use App\Model\Dang_ky_sach;

class dang_ky_sach_controller extends Controller
{
	public function view_dang_ky_sach()
	{
		$array_dang_ky_sach = Dang_ky_sach::get_all_dang_ky_sach();
		return view ('view_dang_ky_sach',['array_dang_ky_sach' => $array_dang_ky_sach]);
	}
}