<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Builder;
use Request;
use App\Helper;
use App\Model\DangKySach;
use App\Model\ChuyenNganh;
use App\Model\KhoaHoc;
use App\Model\Sach;
use Excel;
use App\Exports\DangKySachExport;
use PDF;

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
		$array_chuyen_nganh = ChuyenNganh::all();
		$array_khoa_hoc = KhoaHoc::all();
	
		$ma_chuyen_nganh = Request::get('ma_chuyen_nganh');
		$ma_sinh_vien = Request::get('ma_sinh_vien');
		$ma_lop = Request::get('ma_lop');
		$ma_sach = Request::get('ma_sach');
		
		$array_dang_ky_sach = DangKySach::query()
							->join('sinh_vien','dang_ky_sach.ma_sinh_vien','=','sinh_vien.ma_sinh_vien')
							->join('sach','dang_ky_sach.ma_sach','=','sach.ma_sach')
							->join('lop','sinh_vien.ma_lop','=','lop.ma_lop')
							->join('chuyen_nganh','lop.ma_chuyen_nganh','=','chuyen_nganh.ma_chuyen_nganh');
		if(!empty($ma_chuyen_nganh)){
			$array_dang_ky_sach = $array_dang_ky_sach->where('chuyen_nganh.ma_chuyen_nganh','=',$ma_chuyen_nganh);
		}
		if(!empty($ma_lop)){
			$array_dang_ky_sach = $array_dang_ky_sach->where('lop.ma_lop','=',$ma_lop);
		}
		if(!empty($ma_sinh_vien)){
			$array_dang_ky_sach = $array_dang_ky_sach->where('sinh_vien.ma_sinh_vien','=',$ma_sinh_vien);
		}
		if(!empty($ma_sach)){
			$array_dang_ky_sach = $array_dang_ky_sach->where('sach.ma_sach','=',$ma_sach);
		}
		$array_dang_ky_sach = $array_dang_ky_sach->orderBy('ma_dang_ky','desc')->paginate(8);
		$array_dang_ky_sach->appends(array(
			'ma_chuyen_nganh' => Input::get('ma_chuyen_nganh'),
			'ma_lop' => Input::get('ma_lop'),
			'ma_sinh_vien' => Input::get('ma_sinh_vien'),
			'ma_sach' => Input::get('ma_sach')
		));
		if(count($array_dang_ky_sach) == 0){
			$message = "Không tìm thấy kết quả";
			return view("$this->folder.view_all",compact('message','array_dang_ky_sach','array_chuyen_nganh','array_khoa_hoc'));
		}
		return view("$this->folder.view_all",compact('array_dang_ky_sach','array_chuyen_nganh','array_khoa_hoc','ma_chuyen_nganh','ma_lop','ma_sinh_vien','ma_sach'));
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
		if($array_check_so_luong[0]->so_luong_ton_kho > 0){
			$count = DangKySach::where('ma_sinh_vien','=',$dang_ky_sach->ma_sinh_vien)
					->where('ma_sach','=',$dang_ky_sach->ma_sach)->count();
			if($count == 0){
				$dang_ky_sach->save();
				return redirect()->route("$this->folder.view_all")->with('success', 'Đã thêm');
			}
			return redirect()->route("$this->folder.view_all")->with('error', 'Sinh viên đã đăng ký!');
		}
		else return redirect()->route("$this->folder.view_all")->with('error_1', 'Hết sách để đăng ký!');
			
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

	public function export()
	{
		return Excel::download(new DangKySachExport, 'danh_sach_sinh_vien.xlsx');
	}

	public function export_pdf()
	{
		$ma_lop = Request::get('ma_lop');
    	$ma_sach = Request::get('ma_sach');

    	$array_dang_ky_sach = DangKySach::query()
			->join('sinh_vien','dang_ky_sach.ma_sinh_vien','=','sinh_vien.ma_sinh_vien')
			->join('sach','dang_ky_sach.ma_sach','=','sach.ma_sach')
			->join('lop','sinh_vien.ma_lop','=','lop.ma_lop')
			->join('chuyen_nganh','lop.ma_chuyen_nganh','=','chuyen_nganh.ma_chuyen_nganh')
			->where('lop.ma_lop','=',$ma_lop)
			->where('sach.ma_sach','=',$ma_sach)
			->get();

		$pdf = PDF::loadView("$this->folder.view_pdf", ['array_dang_ky_sach' => $array_dang_ky_sach]);
		return $pdf->download('danh_sach_dang_ky.pdf');
	}
	
}