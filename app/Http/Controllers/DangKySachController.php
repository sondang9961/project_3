<?php
namespace App\Http\Controllers;

use Request;
use App\Model\DangKySach;
use App\Model\KhoaHoc;

class DangKySachController extends Controller
{
	private $folder = 'dang_ky_sach';
	public function view_all()
	{
		$array_dang_ky_sach = DangKySach::get_all();

		$khoa_hoc = new KhoaHoc();
		$array_khoa_hoc = $khoa_hoc->get_all();
		return view ("$this->folder.view_all", [
			'array_dang_ky_sach' => $array_dang_ky_sach,
			'array_khoa_hoc' => $array_khoa_hoc,
		]);
	}
}
?>