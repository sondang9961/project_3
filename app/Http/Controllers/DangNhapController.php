<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Session;

/**
 * 
 */
class DangNhapConTroller extends Controller
{
	
	function get_dang_nhap()
	{
		return view('view_dang_nhap');
	}


}