<?php
namespace App\Http\Controllers;

use Request;
use App\Model\KhoaHoc;

class KhoaHocController extends Controller
{
	public function view_all()
	{
		$array_khoa_hoc = KhoaHoc::get_all();
		return view ('khoa_hoc.view_all',['array_khoa_hoc' => $array_khoa_hoc]);
	}
}