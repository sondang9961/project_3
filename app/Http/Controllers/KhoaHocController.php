<?php
namespace App\Http\Controllers;

use Request;
use App\Model\KhoaHoc;

class KhoaHocController extends Controller
{
	private $folder = 'khoa_hoc';
	public function view_all()
	{
		$khoa_hoc = new KhoaHoc();
		$array_khoa_hoc = $khoa_hoc->get_all();

		return view ("$this->folder.view_all",[
			'array_khoa_hoc' => $array_khoa_hoc
		]);
	}

	public function process_insert()
	{
		$khoa_hoc = new KhoaHoc();
		$khoa_hoc->ten_khoa_hoc = Request::get('ten_khoa_hoc');
		$khoa_hoc->insert();

		//điều hướng
		return redirect()->route('khoa_hoc.view_all');
	}

	/*public function view_update($ma_khoa_hoc)
	{
		$khoa_hoc = new KhoaHoc();
		$khoa_hoc->ma_khoa_hoc = $ma_khoa_hoc;
		$array_khoa_hoc = $khoa_hoc->get_one();

		return view("$this->folder.view_update",[
			'array_khoa_hoc' => $array_khoa_hoc
		]);
	}*/

	public function process_update()
	{
		$khoa_hoc = new KhoaHoc();
		$khoa_hoc->ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$khoa_hoc->ten_khoa_hoc = Request::get('ten_khoa_hoc');
		$khoa_hoc->updateKhoaHoc();

		//điều hướng
		return redirect()->route('khoa_hoc.view_all');

	}
}