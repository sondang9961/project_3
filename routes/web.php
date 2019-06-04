<?php

Route::get('trang_chu',"trang_chu_controller@trang_chu");
Route::get('quan_ly_lop',"lop_controller@view_quan_ly_lop");
Route::get('quan_ly_mon_hoc',"mon_hoc_controller@view_quan_ly_mon_hoc");
Route::get('quan_ly_khoa_hoc',"khoa_hoc_controller@view_quan_ly_khoa_hoc");
Route::get('quan_ly_sach',"sach_controller@view_quan_ly_sach");
Route::get('quan_ly_dang_ky_sach',"dang_ky_sach_controller@view_dang_ky_sach");
Route::get('thong_ke',"thong_ke_controller@view_thong_ke");


