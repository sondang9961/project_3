<?php
namespace App\Http\Controllers;

use Request;
use App\Model\Lop;

class LopController extends Controller
{
	public function view_quan_ly_lop()
	{
		$array_lop = Lop::get_all();
		dd($array_lop);
		return view ('view_quan_ly_lop',['array_lop' => $array_lop]);
	}
}