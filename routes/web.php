<?php

Route::get('dang_nhap','Controller@view_dang_nhap')->name('view_dang_nhap');
Route::post('process_login','Controller@process_login')->name('process_login');
Route::post('process_update_profile','Controller@process_update_profile')->name('process_update_profile');


Route::group(['prefix' => 'admin', 'middleware' => 'CheckAdmin'], function(){
	Route::get("","Controller@layer");
	Route::get("trang_chu","Controller@layer")->name('trang_chu');
	Route::get("logout","Controller@logout")->name('logout');
	Route::get("profile","Controller@profile")->name('profile');
	Route::get("thong_ke","ThongKeController@view_thong_ke");
});

//KHÓA HỌC
Route::group(['prefix' => 'admin', 'middleware' => 'CheckAdmin'], function(){
	Route::group(["prefix" => "khoa_hoc"], function(){
		$group = "khoa_hoc";
		$controller = "KhoaHocController";
		Route::get("view_all","$controller@view_all")
		->name("$group.view_all");
		Route::post("process_insert","$controller@process_insert")
		->name("$group.process_insert");
		Route::post("process_update/{ma_khoa_hoc}","$controller@process_update")
		->name("$group.process_update");
	});
});

//LỚP 
Route::group(['prefix' => 'admin', 'middleware' => 'CheckAdmin'], function(){
	Route::group(["prefix" => "lop"], function(){
		$group = "lop";
		$controller = "LopController";
		Route::get("view_all","$controller@view_all")
		->name("$group.view_all");
		Route::post("process_insert","$controller@process_insert")
		->name("$group.process_insert");
		Route::post("process_update/{ma_lop}","$controller@process_update")
		->name("$group.process_update");
		Route::get("get_lop_by_khoa_hoc","$controller@get_lop_by_khoa_hoc")
		->name("get_lop_by_khoa_hoc");
	});
});


//MÔN HỌC
Route::group(['prefix' => 'admin', 'middleware' => 'CheckAdmin'], function(){
	Route::group(["prefix" => "mon_hoc"], function(){
		$group = "mon_hoc";
		$controller = "MonHocController";
		Route::get("view_all","$controller@view_all")
		->name("$group.view_all");
		Route::post("process_insert","$controller@process_insert")
		->name("$group.process_insert");
		Route::post("process_update","$controller@process_update")
		->name("$group.process_update");
		Route::get("get_mon_hoc_by_khoa_hoc","$controller@get_mon_hoc_by_khoa_hoc")
		->name("get_mon_hoc_by_khoa_hoc");
	});
});

//SINH VIÊN
Route::group(['prefix' => 'admin', 'middleware' => 'CheckAdmin'], function(){
	Route::group(["prefix" => "sinh_vien"], function(){
		$group = "sinh_vien";
		$controller = "SinhVienController";
		Route::get("view_all","$controller@view_all")
		->name("$group.view_all");
		Route::post("process_insert","$controller@process_insert")
		->name("$group.process_insert");
		Route::post("process_update/{ma_sinh_vien}","$controller@process_update")
		->name("$group.process_update");
		Route::get("danh_sach_sinh_vien_by_lop/{ma_lop}","$controller@danh_sach_sinh_vien_by_lop")
		->name("$group.danh_sach_sinh_vien_by_lop");
		Route::get("get_sinh_vien_by_lop","$controller@get_sinh_vien_by_lop")
		->name("get_sinh_vien_by_lop");
	});
});

//SÁCH
Route::group(['prefix' => 'admin', 'middleware' => 'CheckAdmin'], function(){
	Route::group(["prefix" => "sach"], function(){
		$group = "sach";
		$controller = "SachController";
		Route::get("view_all","$controller@view_all")
		->name("$group.view_all");
		Route::post("process_insert","$controller@process_insert")
		->name("$group.process_insert");
		Route::post("process_update","$controller@process_update")
		->name("$group.process_update");
		Route::get("get_sach_by_mon_hoc","$controller@get_sach_by_mon_hoc")
		->name("get_sach_by_mon_hoc");
	});
});

//ĐĂNG KÝ SÁCH
Route::group(['prefix' => 'admin', 'middleware' => 'CheckAdmin'], function(){
	Route::group(["prefix" => "dang_ky_sach"], function(){
		Route::get("view_all","DangKySachController@view_all")
		->name("dang_ky_sach.view_all");
		Route::post("process_insert","DangKySachController@process_insert")
		->name("dang_ky_sach.process_insert");
		Route::post("process_update","DangKySachController@process_update")
		->name("dang_ky_sach.process_update");
	});
});

Route::group(["prefix" => "thong_ke"], function(){
	Route::get("view_all","ThongKeController@view_all")
	->name("thong_ke.view_all");
});

