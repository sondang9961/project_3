<?php

namespace App\Http\Controllers;


use Illuminate\Routing\Controller as BaseController;
use Request; 
use Session;
use App\Model\Admin;
use App\Model\GiaoVu;


class Controller extends BaseController
{
    public function layer()
    {
    	return view('layer.master');
    }

    public function trang_chu()
    {
    	return view('layer.master');
    }

    public function view_dang_nhap()
    {
    	return view('view_dang_nhap');
    }

    public function process_login()
    {
    	$giao_vu = new GiaoVu();
    	$giao_vu->email = Request::get('email');
    	$giao_vu->password = Request::get('password');
    	$giao_vu = $giao_vu->check_login();

    	if(count($giao_vu) == 1){
    		Session::put('ma_giao_vu',$giao_vu[0]->ma_giao_vu);
    		Session::put('ten_giao_vu',$giao_vu[0]->ten_giao_vu);

    		return redirect()->route('trang_chu');
    	}
    	return redirect()->route('view_dang_nhap')->with('error', 'Sai username hoặc password');
    }

    public function logout()
    {
        Session::flush();

        return redirect()->route('view_dang_nhap');
    }
}

