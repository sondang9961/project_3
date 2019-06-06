<?php
namespace App\Http\Controllers;

use Request;
use App\Model\MonHoc;

class MonHocController extends Controller
{
	public function view_all()
	{
		$array_mon_hoc = MonHoc::get_all();
		return view ('mon_hoc.view_all',['array_mon_hoc' => $array_mon_hoc]);
	}
}