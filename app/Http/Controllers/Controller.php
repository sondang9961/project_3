<?php

namespace App\Http\Controllers;


use Illuminate\Routing\Controller as BaseController;
use Request; 
use Session;
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
            Session::put('email',$giao_vu[0]->email);
            Session::put('sdt',$giao_vu[0]->sdt);
            Session::put('dia_chi',$giao_vu[0]->dia_chi);

            return redirect()->route('trang_chu');
        }
        return redirect()->route('view_dang_nhap')->with('error', 'Sai username hoặc password');
    }

    public function logout()
    {
        Session::flush();

        return redirect()->route('view_dang_nhap');
    }

    public function profile()
    {
        $giao_vu = new GiaoVu();
        $giao_vu->ma_giao_vu = Session::get('ma_giao_vu');
        $array_giao_vu = $giao_vu->get_one();


        return view ("view_thong_tin_ca_nhan",[
            'array_giao_vu' => $array_giao_vu
        ]);

    }

    public function process_update_profile()
    {
        $giao_vu = new GiaoVu();
        $giao_vu->ma_giao_vu = Request::get('ma_giao_vu');
        $giao_vu->ten_giao_vu = Request::get('ten_giao_vu');
        $giao_vu->email = Request::get('email');
        $giao_vu->sdt = Request::get('sdt');
        $giao_vu->dia_chi = Request::get('dia_chi');
        $giao_vu = $giao_vu->update_profile();

        return redirect()->route('profile');
    }
}