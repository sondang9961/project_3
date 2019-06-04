<?php
namespace App\Http\Controllers;

use Request;
use App\Model\Mon_hoc;

class mon_hoc_controller extends Controller
{
	public function view_quan_ly_mon_hoc()
	{
		$array_mon_hoc = Mon_hoc::get_all_mon_hoc();
		return view ('view_quan_ly_mon_hoc',['array_mon_hoc' => $array_mon_hoc]);
	}
}