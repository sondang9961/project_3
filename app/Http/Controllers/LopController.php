<?php
namespace App\Http\Controllers;

use Request;
use App\Model\Lop;
use App\Model\KhoaHoc;

class LopController extends Controller
{
	private $folder = 'lop';
	public function view_all()
	{
		$lop = new Lop();
		$array_lop = $lop->get_all();
		//dd($array_lop);

		$khoa_hoc = new KhoaHoc();
		$array_khoa_hoc = $khoa_hoc->get_all();
		return view ("$this->folder.view_all",[
			'array_lop' => $array_lop,
			'array_khoa_hoc' => $array_khoa_hoc
		]);
		
	}

	public function process_insert()
	{
		$lop = new Lop();
		$lop->ten_lop = Request::get('ten_lop');
		$lop->ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$lop->insert();

		//điều hướng
		return redirect()->route("$this->folder.view_all"); 
	}

	public function process_update($ma_lop)
	{
		$lop = new Lop();
		$lop->ma_lop = $ma_lop;
		$lop->ten_lop = Request::get('ten_lop');
		$lop->ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$lop->updateLop();

		//điều hướng
		return redirect()->route("$this->folder.view_all"); 
	}

}