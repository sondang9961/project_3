<?php
namespace App\Http\Controllers;

use Request;
use App\Model\Sach;

class sach_controller extends Controller
{
	public function view_quan_ly_sach()
	{
		$array_sach = Sach::get_all_sach();
		return view ('view_quan_ly_sach',['array_sach' => $array_sach]);
	}
}