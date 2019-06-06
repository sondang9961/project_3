<?php
namespace App\Http\Controllers;

use Request;
use App\Model\Lop;

class LopController extends Controller
{
	public function view_all()
	{
		$array_lop = Lop::get_all();
		//dd($array_lop);
		return view ('lop.view_all',['array_lop' => $array_lop]);
	}
}