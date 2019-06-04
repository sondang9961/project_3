<?php
namespace App\Http\Controllers;

use Request;

class a_cong_b_controller extends Controller
{
	public function nhap(){
		return view('view_a_cong_b');
	}
	public function xu_ly_nhap(){
		$a = Request::get('a');
		$b = Request::get('b');
		$tong = $a + $b;
		$hieu = $a - $b;
		$tich = $a * $b;
		$thuong = $a / $b;
		return view("ket_qua",compact('tong','hieu','tich','thuong')) ;
	}
}
