<?php
namespace App\Http\Controllers;

use Request;
use App\Model\SinhVien;
use App\Model\Lop;

class SinhVienController extends Controller
{
	private $folder='sinh_vien';
	public function view_all()
	{
		$sinh_vien = new SinhVien();
		$array_sinh_vien = $sinh_vien->get_all();

		$lop = new Lop();
		$array_lop = $lop->get_all();
		return view ("$this->folder.view_all",[
			'array_sinh_vien' => $array_sinh_vien, 
			'array_lop' => $array_lop
		]);
	}

	public function process_insert()
	{
		$sinh_vien = new SinhVien();
		$sinh_vien->ten_sinh_vien = Request::get('ten_sinh_vien');
		$sinh_vien->ma_lop        = Request::get('ma_lop');
		$sinh_vien->insert();

		return redirect()->route("$this->folder.view_all");
	}

	public function process_update($ma_sinh_vien)
	{
		$sinh_vien = new SinhVien();
		$sinh_vien->ma_sinh_vien = $ma_sinh_vien;
		$sinh_vien->ten_sinh_vien = Request::get('ten_sinh_vien');
		$sinh_vien->ma_lop = Request::get('ma_lop');
		$sinh_vien->updateSinhVien();

		return redirect()->route("$this->folder.view_all");
	}

	public function danh_sach_sinh_vien_by_lop($ma_lop)
	{
		$sinh_vien = new SinhVien();
		$sinh_vien->ma_lop = $ma_lop;
		$array_sinh_vien = $sinh_vien->danh_sach_sinh_vien_by_lop();

		$lop = new Lop();
		$lop->ma_lop = $ma_lop;
		$array_lop = $lop->danh_sach_lop();

		return view("$this->folder.danh_sach_sinh_vien_by_lop",[
			'array_sinh_vien' => $array_sinh_vien,
			'array_lop' => $array_lop
		]);
	}
}