<?php
namespace App\Http\Controllers;

use Request;
use Response;
use App\Model\MonHoc;
use App\Model\KhoaHoc;

class MonHocController extends Controller
{
	private $folder = 'mon_hoc';
	public function view_all()
	{
		$trang = Request::get('trang');

		if(empty($trang)){
			$trang = 1;
		}
		
		$limit = 5;
		$mon_hoc = new MonHoc();
		$mon_hoc->offset = ($trang - 1)*$limit;
		$mon_hoc->limit = $limit;
		$ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$mon_hoc->ma_khoa_hoc = $ma_khoa_hoc;
		$array_mon_hoc = $mon_hoc->get_all();

		$count_trang = ceil($mon_hoc->count());

		$khoa_hoc = new KhoaHoc();
		$array_khoa_hoc = $khoa_hoc->get_all();
		return view ("$this->folder.view_all",[
			'array_mon_hoc' => $array_mon_hoc,
			'array_khoa_hoc' => $array_khoa_hoc,
			'count_trang' => $count_trang,
			'ma_khoa_hoc' => $ma_khoa_hoc,
			'trang' => $trang,
			'mon_hoc' => $mon_hoc
		]);
	}

	public function get_mon_hoc_by_khoa_hoc()
	{
		$mon_hoc = new MonHoc();
		$mon_hoc->ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$array_mon_hoc = $mon_hoc->get_all_by_khoa_hoc();
		return $array_mon_hoc;
	}

	public function process_insert()
	{
		$mon_hoc = new MonHoc();
		$mon_hoc->ten_mon_hoc = Request::get('ten_mon_hoc');
		$mon_hoc->ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$array_mon_hoc = $mon_hoc->check_insert();
		if(count($array_mon_hoc) == 0) {
			$mon_hoc->insert();
			return redirect()->route("$this->folder.view_all")->with('success','Đã thêm');
		}
		return redirect()->route("$this->folder.view_all")->with('error','Môn học đã tồn tại!');
		
	}

	public function process_update($ma_mon_hoc)
 	{
 		$mon_hoc = new MonHoc();
 		$mon_hoc->ma_mon_hoc = Request::get('ma_mon_hoc');
 		$mon_hoc->ten_mon_hoc = Request::get('ten_mon_hoc');
		$mon_hoc->ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$mon_hoc->updateMonHoc();

		return redirect()->route("$this->folder.view_all");
 	}	

 	public function get_one()
	{
		$mon_hoc = new MonHoc();
		$mon_hoc->ma_mon_hoc = Request::get('ma_mon_hoc');
		$mon_hoc = $mon_hoc->get_one();
		
		return Response::json($mon_hoc);
	}
}