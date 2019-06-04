<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class sinh_vien_controller extends Controller
{
    public function view_all(){
    	return "Đây là tất cả sinh viên";
    }
    public function view_one($ma_sinh_vien){
    	return "Đây là sinh viên $ma_sinh_vien";
    }
}

