<?php

Route::get('dang_nhap',"DangNhapController@get_dang_nhap");
Route::get('trang_chu',"Controller@layer");
Route::get('',"Controller@layer");
Route::get('thong_ke',"ThongKeController@view_thong_ke");



Route::group(['prefix' => 'khoa_hoc'], function(){
	Route::get('view_all','KhoaHocController@view_all')
	->name('khoa_hoc.view_all');
	Route::post('process_insert','KhoaHocController@process_insert')
	->name('khoa_hoc.process_insert');
	Route::get('view_update/{ma_khoa_hoc}','KhoaHocController@view_update')
	->name('khoa_hoc.view_update');
	Route::post('process_update','KhoaHocController@process_update')
	->name('khoa_hoc.process_update');
});

Route::group(['prefix' => 'lop'], function(){
	Route::get('view_all','LopController@view_all')
	->name('lop.view_all');
	Route::post('process_insert','LopController@process_insert')
	->name('lop.process_insert');
	Route::post('process_update','KhoaHocController@process_update')
	->name('khoa_hoc.process_update');
});

Route::group(['prefix' => 'mon_hoc'], function(){
	Route::get('view_all','MonHocController@view_all')
	->name('mon_hoc.view_all');
	Route::post('process_insert','MonHocController@process_insert')
	->name('mon_hoc.process_insert');
	Route::post('process_update','MonHocController@process_update')
	->name('mon_hoc.process_update');
});

Route::group(['prefix' => 'sinh_vien'], function(){
	Route::get('view_all','SinhVienController@view_all')
	->name('sinh_vien.view_all');
	Route::post('process_insert','SinhVienController@process_insert')
	->name('sinh_vien.process_insert');
	Route::post('process_update','SinhVienController@process_update')
	->name('sinh_vien.process_update');
});

Route::group(['prefix' => 'sach'], function(){
	Route::get('view_all','SachController@view_all')
	->name('sach.view_all');
	Route::get('get_mon_hoc_by_khoa_hoc','SachController@get_mon_hoc_by_khoa_hoc')
	->name('get_mon_hoc_by_khoa_hoc');
	Route::post('process_insert','SachController@process_insert')
	->name('sach.process_insert');
	Route::post('process_update','SachController@process_update')
	->name('sach.process_update');
});

Route::group(['prefix' => 'dang_ky_sach'], function(){
	Route::get('view_all','DangKySachController@view_all')
	->name('dang_ky_sach.view_all');
	Route::post('process_insert','DangKySachController@process_insert')
	->name('dang_ky_sach.process_insert');
	Route::post('process_update','DangKySachController@process_update')
	->name('dang_ky_sach.process_update');
});

Route::group(['prefix' => 'thong_ke'], function(){
	Route::get('view_all','ThongKeController@view_all')
	->name('thong_ke.view_all');
});

