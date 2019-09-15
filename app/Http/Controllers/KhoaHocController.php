<?php
namespace App\Http\Controllers;

use Request;
use Response;
use App\Model\KhoaHoc;

class KhoaHocController extends Controller
{
	private $folder = 'khoa_hoc';
	public function view_all()
	{
		$trang = Request::get('trang');

		if(empty($trang)){
			$trang = 1;
		}
		
		$limit = 5;
		$khoa_hoc = new KhoaHoc();
		$khoa_hoc->offset = ($trang - 1)*$limit;
		$khoa_hoc->limit = $limit;
		$ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$khoa_hoc->ma_khoa_hoc = $ma_khoa_hoc;
		$array_khoa_hoc = $khoa_hoc->get_all();
		$array_all_khoa_hoc = $khoa_hoc->get_all_khoa_hoc();

		$count_trang = ceil($khoa_hoc->count());

		if ($trang > 1) $prev = $trang - 1; else $prev = 0;
		if ($trang < $count_trang) $next = $trang + 1; else $next = 0;
		if ($trang <= 3) $startpage = 1;
		else if ($trang == $count_trang) $startpage = $trang - 6;
		else if ($trang == $count_trang - 2) $startpage = $trang - 5;
		else if ($trang == $count_trang - 1) $startpage = $trang - 4;
		else $startpage = $trang - 3;
		$endpage = $startpage + 6;

		return view ("$this->folder.view_all",[
			'array_khoa_hoc' => $array_khoa_hoc,
			'array_all_khoa_hoc' => $array_all_khoa_hoc,
			'ma_khoa_hoc' => $ma_khoa_hoc,
			'count_trang' => $count_trang,
			'trang' => $trang,
			'prev' => $prev,
			'next' => $next,
			'startpage' => $startpage,
			'endpage' => $endpage
		]);
	}

	public function process_insert()
	{
		$khoa_hoc = new KhoaHoc();
		$khoa_hoc->ten_khoa_hoc = Request::get('ten_khoa_hoc');
		$array_khoa_hoc = $khoa_hoc->check_insert();
		if(count($array_khoa_hoc) == 0){
			$khoa_hoc->insert();
			return redirect()->route("$this->folder.view_all")->with('success', 'Đã thêm');
		}
		//điều hướng
		return redirect()->route("$this->folder.view_all")->with('error', 'Khóa học đã tồn tại');
	}

	
	public function process_update($ma_khoa_hoc)
	{
		$khoa_hoc = new KhoaHoc();
		$khoa_hoc->ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$khoa_hoc->ten_khoa_hoc = Request::get('ten_khoa_hoc');
		$khoa_hoc->updateKhoaHoc();

		//điều hướng
		return redirect()->route("$this->folder.view_all");

	}
	public function get_one()
	{
		$khoa_hoc = new KhoaHoc();
		$khoa_hoc->ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$khoa_hoc = $khoa_hoc->get_one();
		
		return Response::json($khoa_hoc);
	}
}