<?php
namespace App\Http\Controllers;

use Request;
use App\Helper;
use App\Model\DangKySach;
use App\Model\KhoaHoc;

class DangKySachController extends Controller
{
	private $folder = 'dang_ky_sach';
	public function view_all()
	{
		$dang_ky_sach = new DangKySach();
		$array_dang_ky_sach = $dang_ky_sach->get_all();

		$khoa_hoc = new KhoaHoc();
		$array_khoa_hoc = $khoa_hoc->get_all();
		return view ("$this->folder.view_all", [
			'array_dang_ky_sach' => $array_dang_ky_sach,
			'array_khoa_hoc' => $array_khoa_hoc,
		]);
	}
	public function change_tinh_trang_dang_ky_sach()
	{
		$ma_dang_ky = Request::get('ma_dang_ky');
		$tinh_trang_nhan_sach = Request::get('tinh_trang_nhan_sach');

		$dang_ky_sach = new DangKySach();
		$dang_ky_sach->ma_dang_ky = $ma_dang_ky;
		$dang_ky_sach->tinh_trang_nhan_sach = $tinh_trang_nhan_sach;
		$dang_ky_sach->updateTinhTrang();

		$dang_ky_sach = $dang_ky_sach->getTenTinhTrangFromMaDangKy();
		return Helper::getTenTinhTrang($dang_ky_sach->tinh_trang_nhan_sach);
	}
}
?>