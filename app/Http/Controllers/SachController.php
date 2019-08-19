<?php
namespace App\Http\Controllers;

use Request;
use Response;
use App\Model\Sach;
use App\Model\KhoaHoc;
use App\Model\MonHoc;

class SachController extends Controller
{
	private $folder = 'sach';
	public function view_all()
	{
		$trang = Request::get('trang');

		if(empty($trang)){
			$trang = 1;
		}
		
		$limit = 5;
		$sach = new Sach();
		$sach->offset = ($trang - 1)*$limit;
		$sach->limit = $limit;
		$ma_mon_hoc = Request::get('ma_mon_hoc');
		$ma_sach = Request::get('ma_sach');
		$sach->ma_mon_hoc = $ma_mon_hoc;
		$sach->ma_sach = $ma_sach;
		$array_sach = $sach->get_all();

		$count_trang = ceil($sach->count());

		$mon_hoc = new MonHoc();
		$array_mon_hoc = $mon_hoc->get_all();

		$khoa_hoc = new KhoaHoc();
		$array_khoa_hoc = $khoa_hoc->get_all();

		return view ("$this->folder.view_all", [
			'array_sach' => $array_sach,
			'array_mon_hoc' => $array_mon_hoc,
			'array_khoa_hoc' => $array_khoa_hoc,
			'count_trang' => $count_trang,
			'ma_mon_hoc' => $ma_mon_hoc,
			'ma_sach' => $ma_sach,
			'trang' => $trang,
			'sach' => $sach
		]);
	}

	public function get_sach_by_mon_hoc()
	{
		$sach = new Sach();
		$sach->ma_mon_hoc = Request::get('ma_mon_hoc');
		$array_sach = $sach->get_all_by_mon_hoc();
		return $array_sach;
	}

	public function get_sach_by_lop()
	{
		$sach = new Sach();
		$sach->ma_lop = Request::get('ma_lop');
		$array_sach = $sach->get_all_by_lop();
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

	public function process_update()
	{
		$sach = new Sach();
		$sach->ma_sach = Request::get('ma_sach');
		$sach->ma_mon_hoc = Request::get('ma_mon_hoc');
		$sach->ten_sach = Request::get('ten_sach');
		$sach->so_luong_nhap = Request::get('so_luong_nhap');
		$sach->ngay_nhap_sach = Request::get('ngay_nhap_sach');
		$sach->ngay_het_han = Request::get('ngay_het_han');
		
		$sach->updateSach();
		return redirect()->route("$this->folder.view_all");
	}

	public function get_one()
	{
		$sach = new Sach();
		$sach->ma_sach = Request::get('ma_sach');
		$sach = $sach->get_one();
		
		return Response::json($sach);
	}
}