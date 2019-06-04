<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class trang_chu_controller extends Controller
{
	public function trang_chu(){
		return view('view_trang_chu');
	}
	public function view_quan_ly_lop()
	{
		$array_lop = Lop::get_all();
		dd($array_lop);
		return view ('view_quan_ly_lop',['array_lop' => $array_lop]);
	}
}
