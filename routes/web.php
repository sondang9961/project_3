<?php

Route::get('trang_chu',"trang_chu_controller@trang_chu");
Route::get('thong_ke',"thong_ke_controller@view_thong_ke");

Route::group(['prefix' => 'khoa_hoc'], function(){
	Route::get('view_all','KhoaHocController@view_all')
	->name('khoa_hoc.view_all');
	Route::post('process_insert','KhoaHocController@process_insert')
	->name('khoa_hoc.process_insert');
	Route::get('view_update','KhoaHocController@view_update')
	->name('khoa_hoc.view_update');
	Route::post('process_update','KhoaHocController@process_update')
	->name('khoa_hoc.process_update');
});

Route::group(['prefix' => 'lop'], function(){
	Route::get('view_all','LopController@view_all')
	->name('lop.view_all');
	Route::post('process_insert','LopController@process_insert')
	->name('lop.process_insert');
	Route::get('view_update','KhoaHocController@view_update')
	->name('khoa_hoc.view_update');
	Route::post('process_update','KhoaHocController@process_update')
	->name('khoa_hoc.process_update');
});

Route::group(['prefix' => 'mon_hoc'], function(){
	Route::get('view_all','MonHocController@view_all')
	->name('mon_hoc.view_all');
	Route::post('process_insert','MonHocController@process_insert')
	->name('mon_hoc.process_insert');
	Route::get('view_update','MonHocController@view_update')
	->name('mon_hoc.view_update');
	Route::post('process_update','MonHocController@process_update')
	->name('mon_hoc.process_update');
});

Route::group(['prefix' => 'sinh_vien'], function(){
	Route::get('view_all','SinhVienController@view_all')
	->name('sinh_vien.view_all');
	Route::post('process_insert','SinhVienController@process_insert')
	->name('sinh_vien.process_insert');
	Route::get('view_update','SinhVienController@view_update')
	->name('sinh_vien.view_update');
	Route::post('process_update','SinhVienController@process_update')
	->name('sinh_vien.process_update');
});

Route::group(['prefix' => 'sach'], function(){
	Route::get('view_all','SachController@view_all')
	->name('sach.view_all');
	Route::post('process_insert','SachController@process_insert')
	->name('sach.process_insert');
	Route::get('view_update','SachController@view_update')
	->name('sach.view_update');
	Route::post('process_update','SachController@process_update')
	->name('sach.process_update');
});

Route::group(['prefix' => 'quan_ly_sach'], function(){
	Route::get('view_all','QuanLySachController@view_all')
	->name('quan_ly_sach.view_all');
	Route::post('process_insert','QuanLySachController@process_insert')
	->name('quan_ly_sach.process_insert');
	Route::get('view_update','QuanLySachController@view_update')
	->name('quan_ly_sach.view_update');
	Route::post('process_update','QuanLySachController@process_update')
	->name('quan_ly_sach.process_update');
});