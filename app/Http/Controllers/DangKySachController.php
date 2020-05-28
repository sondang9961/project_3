<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Request;
use App\Helper;
use App\Model\DangKySach;
use App\Model\KhoaHoc;
use App\Model\Sach;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}
class DangKySachController extends Controller
{
	private $folder = 'dang_ky_sach';
	public function view_all()
	{
		$array_dang_ky_sach= DangKySach::query()
							->join('sinh_vien','dang_ky_sach.ma_sinh_vien','=','sinh_vien.ma_sinh_vien')
							->join('sach','dang_ky_sach.ma_sach','=','sach.ma_sach')
							->join('lop','sinh_vien.ma_lop','=','lop.ma_lop')
							->orderBy('ma_dang_ky','desc')->paginate(5);

		$array_khoa_hoc = KhoaHoc::all();
	
		$ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$ma_mon_hoc = Request::get('ma_mon_hoc');
		$ma_lop = Request::get('ma_lop');
		$ma_sach = Request::get('ma_sach');
		
		if($ma_khoa_hoc != '' && $ma_lop != '' && $ma_mon_hoc != '' && $ma_sach != ''){
			$array_dang_ky_sach = DangKySach::query()
								->join('sinh_vien','dang_ky_sach.ma_sinh_vien','=','sinh_vien.ma_sinh_vien')
								->join('sach','dang_ky_sach.ma_sach','=','sach.ma_sach')
								->join('lop','sinh_vien.ma_lop','=','lop.ma_lop')
								->where('ma_khoa_hoc','=',$ma_khoa_hoc)
								->where('ma_mon_hoc','=',$ma_mon_hoc)
								->where('lop.ma_lop','=',$ma_lop)
								->where('sach.ma_sach','=',$ma_sach)
								->orderBy('ma_dang_ky','desc')
								->paginate(5);
			$array_dang_ky_sach->appends(array(
				'ma_khoa_hoc' => Request::get('ma_khoa_hoc'),
				'ma_mon_hoc' => Request::get('ma_mon_hoc'),
				'ma_lop' => Request::get('ma_lop'),
				'ma_sach' => Request::get('ma_sach'),
			));
			if(count($array_dang_ky_sach) > 0){
				return view("$this->folder.view_all",compact('array_dang_ky_sach','array_khoa_hoc'));
			}
			$message = "Không tìm thấy môn, khóa học!";
			return view("$this->folder.view_all",compact('message','array_dang_ky_sach','array_khoa_hoc'));
		}
		else {
			return view("$this->folder.view_all",compact('array_dang_ky_sach','array_khoa_hoc'));
		}
	}

	public function process_insert()
	{
		$dang_ky_sach = new DangKySach();
		$dang_ky_sach->ma_sinh_vien = Request::get('ma_sinh_vien');
		$dang_ky_sach->ma_sach = Request::get('ma_sach');
		$dang_ky_sach->ngay_dang_ky = date("Y-m-d");	
		$dang_ky_sach->tinh_trang_nhan_sach = Request::get('tinh_trang_nhan_sach');
		if (Request::get('tinh_trang_nhan_sach') == 1) {
			$dang_ky_sach->ngay_nhan_sach = date("Y-m-d");
		}
		$array_check_so_luong = $dang_ky_sach->check_so_luong();
		//Nếu số lượng tồn kho > 0
		foreach ($array_check_so_luong as $check_so_luong) {
			if($check_so_luong->so_luong_ton_kho > 0)
			{
				$array_dang_ky_sach = $dang_ky_sach->check_insert();
				if(count($array_dang_ky_sach) == 0){
					$dang_ky_sach->insert();
					return redirect()->route("$this->folder.view_all")->with('success', 'Đã thêm');
				}
				if(count($array_dang_ky_sach) == 1){
					return redirect()->route("$this->folder.view_all")->with('error', 'Sinh viên đã đăng ký!');
				}
			}
			else return redirect()->route("$this->folder.view_all")->with('error_1', 'Hết sách để đăng ký!');
		}
			
	}

	public function change_tinh_trang_dang_ky_sach()
	{
		$ma_dang_ky = Request::get('ma_dang_ky');
		$tinh_trang_nhan_sach = Request::get('tinh_trang_nhan_sach');

		switch ($tinh_trang_nhan_sach) {
			case 0:
				$dang_ky_sach = new DangKySach();
				$dang_ky_sach->ma_dang_ky = $ma_dang_ky;
				$dang_ky_sach->tinh_trang_nhan_sach = $tinh_trang_nhan_sach;
				$dang_ky_sach->ngay_nhan_sach = null;
				$dang_ky_sach->updateTinhTrang();
				break;
			case 1:
				$dang_ky_sach = new DangKySach();
				$dang_ky_sach->ma_dang_ky = $ma_dang_ky;
				$dang_ky_sach->tinh_trang_nhan_sach = $tinh_trang_nhan_sach;
				$dang_ky_sach->ngay_nhan_sach = date('Y-m-d');
				$dang_ky_sach->updateTinhTrang();
				break;
		}
		
	}

	public function get_sach_by_mon_hoc_1()
	{
		$dang_ky_sach = new DangKySach();
		$dang_ky_sach->ma_mon_hoc = Request::get('ma_mon_hoc');
		$array_dang_ky_sach = $dang_ky_sach->get_all_by_mon_hoc_1();
		
		return $array_dang_ky_sach;
	}
}
