<?php
namespace App\Http\Controllers;

use Request;
use App\Model\Sach;
use App\Model\KhoaHoc;
use App\Model\MonHoc;

class SachController extends Controller
{
	private $folder = 'sach';
	public function view_all()
	{
		$sach = new Sach();
		$array_sach = $sach->get_all();

		$mon_hoc = new MonHoc();
		$array_mon_hoc = $mon_hoc->get_all();

		$khoa_hoc = new KhoaHoc();
		$array_khoa_hoc = $khoa_hoc->get_all();
		return view ("$this->folder.view_all", [
			'array_sach' => $array_sach,
			'array_mon_hoc' => $array_mon_hoc,
			'array_khoa_hoc' => $array_khoa_hoc
		]);
	}

	public function get_sach_by_mon_hoc()
	{
		$sach = new Sach();
		$sach->ma_mon_hoc = Request::get('ma_mon_hoc');
		$array_sach = $sach->get_all_by_mon_hoc();
		return $array_sach;
	}

	public function process_insert()
	{
		$sach = new Sach();
		$sach->ma_mon_hoc = Request::get('ma_mon_hoc');
		$sach->ten_sach = Request::get('ten_sach');
		$sach->so_luong_nhap = Request::get('so_luong_nhap');
		$sach->ngay_nhap_sach= date("Y-m-d");
		$sach->ngay_het_han = date("Y-m-d",strtotime("+ 14 day"));
		
		$sach->insert();
		return redirect()->route("$this->folder.view_all");
	}
}