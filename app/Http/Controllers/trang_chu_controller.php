<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class trang_chu_controller extends Controller
{
	public function trang_chu(){
		return view('view_trang_chu');
	}
}
