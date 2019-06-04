<?php
namespace App\Http\Controllers;

use Request;
use App\Model\Lop;

class lop_controller extends Controller
{
	public function view_quan_ly_lop()
	{
		$array_lop = Lop::get_all_lop();
		//dd($array_lop);
		return view ('view_quan_ly_lop',['array_lop' => $array_lop]);
	}
}