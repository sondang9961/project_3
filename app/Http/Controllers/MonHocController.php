<?php
namespace App\Http\Controllers;

use Request;
use App\Model\MonHoc;
use App\Model\KhoaHoc;

class MonHocController extends Controller
{
	private $folder = 'mon_hoc';
	public function view_all()
	{
		$mon_hoc = new MonHoc();
		$array_mon_hoc = $mon_hoc->get_all();

		$khoa_hoc = new KhoaHoc();
		$array_khoa_hoc = $khoa_hoc->get_all();
		return view ("$this->folder.view_all",['array_mon_hoc' => $array_mon_hoc],['array_khoa_hoc' => $array_khoa_hoc]);
	}

	public function process_insert()
	{
		$mon_hoc = new MonHoc();
		$mon_hoc->ten_mon_hoc = Request::get('ten_mon_hoc');
		$mon_hoc->ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$mon_hoc->insert();

		return redirect()->route("$this->folder.view_all");
	}
}