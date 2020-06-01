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
        return view('view_trang_chu');
    }

    public function view_dang_nhap()
    {
        return view('view_dang_nhap');
    }

    public function view_doi_mat_khau()
    {
        return view('view_doi_mat_khau');
    }

    public function process_login()
    {
        $giao_vu = GiaoVu::query()->where('username','=',Request::get('username'))->first();

        $check = password_verify(Request::get('password'), $giao_vu->password);

        if($check == true && !empty($giao_vu)){
            Session::put('ma_giao_vu',$giao_vu->ma_giao_vu);
            Session::put('ten_giao_vu',$giao_vu->ten_giao_vu);
            Session::put('email',$giao_vu->email);
            Session::put('sdt',$giao_vu->sdt);
            Session::put('dia_chi',$giao_vu->dia_chi);

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
        $ma_giao_vu = Session::get('ma_giao_vu');
        $array_giao_vu = GiaoVu::where('ma_giao_vu','=',$ma_giao_vu)->first();

        return view ("view_thong_tin_ca_nhan",['array_giao_vu' => $array_giao_vu]);
    }

    public function process_update_profile()
    {
        $ma_giao_vu = Request::get('ma_giao_vu');
        $ten_giao_vu = Request::get('ten_giao_vu');
        $email = Request::get('email');
        $sdt = Request::get('sdt');
        $dia_chi = Request::get('dia_chi');
        GiaoVu::where('ma_giao_vu','=',$ma_giao_vu)
            ->update([
                'ten_giao_vu' => $ten_giao_vu,
                'email' => $email,
                'sdt' => $sdt,
                'dia_chi' => $dia_chi,
            ]);

        return redirect()->route('profile');
    }

    public function process_update_mat_khau()
    {
        $giao_vu = GiaoVu::query()->where('ma_giao_vu','=',Request::get('ma_giao_vu'))->first();

        $check = password_verify(Request::get('old_password'), $giao_vu->password);

        if(!$check){
            return redirect()->route("view_doi_mat_khau")->with('error','Mật khẩu cũ không đúng!');
        }
        $giao_vu->password = password_hash(Request::get('new_password'), PASSWORD_BCRYPT);
        GiaoVu::where('ma_giao_vu','=',Request::get('ma_giao_vu'))->update(['password' => $giao_vu->password]);
        return redirect()->route('view_doi_mat_khau')->with('success','Cập nhật thành công!');
    }

}