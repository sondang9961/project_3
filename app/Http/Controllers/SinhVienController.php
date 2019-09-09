<?php
namespace App\Http\Controllers;

use Request;
use Response;
use App\Model\SinhVien;
use App\Model\Lop;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}
class SinhVienController extends Controller
{
	private $folder='sinh_vien';
	public function view_all()
	{
		$trang = Request::get('trang');
		
		if(empty($trang)){
			$trang = 1;
		}
		//dd($trang);
		$ma_lop =  Request::get('ma_lop');

		$limit = 5;
		$sinh_vien = new SinhVien();
		$sinh_vien->offset = ($trang - 1)*$limit;
		$sinh_vien->limit = $limit;
		$sinh_vien->ma_lop = $ma_lop;
		$array_sinh_vien = $sinh_vien->get_all();
		$count_trang = ceil($sinh_vien->count());

		$lop = new Lop();
		$array_lop = $lop->get_all_lop();

		if ($trang > 1) $prev = $trang - 1; else $prev = 0;
		if ($trang < $count_trang) $next = $trang + 1; else $next = 0;
		if ($trang <= 3) $startpage = 1;
		else if ($trang == $count_trang) $startpage = $trang - 6;
		else if ($trang == $count_trang - 2) $startpage = $trang - 5;
		else if ($trang == $count_trang - 1) $startpage = $trang - 4;
		else $startpage = $trang - 3;
		$endpage = $startpage + 6;
		return view ("$this->folder.view_all",[
			'array_sinh_vien' => $array_sinh_vien, 
			'array_lop' => $array_lop,
			'count_trang' => $count_trang,
			'ma_lop' => $ma_lop,
			'trang' => $trang,
			'sinh_vien' => $sinh_vien,
			'prev' => $prev,
			'next' => $next,
			'startpage' => $startpage,
			'endpage' => $endpage
		]);	
	}

	public function get_sinh_vien_by_lop()
	{
		$sinh_vien = new SinhVien();
		$sinh_vien->ma_lop = Request::get('ma_lop');
		$array_sinh_vien = $sinh_vien->get_all_by_lop();
		return $array_sinh_vien;
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
		$sinh_vien->ma_sinh_vien = Request::get('ma_sinh_vien');
		$sinh_vien->ten_sinh_vien = Request::get('ten_sinh_vien');
		$sinh_vien->ma_lop = Request::get('ma_lop');
		$sinh_vien->updateSinhVien();

		return redirect()->route("$this->folder.view_all");
	}

	public function danh_sach_sinh_vien_by_lop($ma_lop)
	{
		$trang = Request::get('trang');
		
		if(empty($trang)){
			$trang = 1;
		}

		$limit = 4;
		$sinh_vien = new SinhVien();
		$sinh_vien->ma_lop = $ma_lop;
		$sinh_vien->offset = ($trang - 1)*$limit;
		$array_sinh_vien_by_lop = $sinh_vien->danh_sach_sinh_vien_by_lop();
		$count_trang = ceil($sinh_vien->count_sinh_vien_by_lop());

		$lop = new Lop();
		$lop->ma_lop = $ma_lop;
		$array_lop = $lop->danh_sach_lop();

		return view("$this->folder.danh_sach_sinh_vien_by_lop",[
			'array_sinh_vien_by_lop' => $array_sinh_vien_by_lop,
			'array_lop' => $array_lop,
			'count_trang' => $count_trang,
			'ma_lop' => $ma_lop,
			'trang' => $trang,
			'sinh_vien' => $sinh_vien
		]);
	}

	public function get_one()
	{
		$sinh_vien = new SinhVien();
		$sinh_vien->ma_sinh_vien = Request::get('ma_sinh_vien');
		$sinh_vien = $sinh_vien->get_one();
		
		return Response::json($sinh_vien);
	}
}