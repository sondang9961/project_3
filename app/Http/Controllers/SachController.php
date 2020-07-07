<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Request;
use Response;
use App\Model\Sach;
use App\Model\KhoaHoc;
use App\Model\ChuyenNganh;
use App\Model\Lop;
use App\Model\SinhVien;
use App\Model\MonHoc;

class SachController extends Controller
{
	private $folder = 'sach';
	public function view_all()
	{
		$array_khoa_hoc = KhoaHoc::all();

		$array_mon_hoc = MonHoc::all();

		$array_sach = Sach::query()
				->join('mon_hoc','sach.ma_mon_hoc','=','mon_hoc.ma_mon_hoc')
				->orderBy('ma_sach','desc')->paginate(5);

		$search = Request::get('search');
		if($search != ''){
			$array_sach = Sach::query()
				->join('mon_hoc','sach.ma_mon_hoc','=','mon_hoc.ma_mon_hoc')
                ->where('ten_mon_hoc','LIKE','%'.$search.'%')
				->orWhere('ten_sach','LIKE','%'.$search.'%')
                ->orderBy('ma_sach','desc')->paginate(3);

            $array_sach->appends(array('search' => Input::get('search')));
			if(count($array_sach) > 0){
				return view("$this->folder.view_all",compact('array_sach','array_mon_hoc','array_khoa_hoc'));
				}
				$message = "Không tìm thấy kết quả";
				return view("$this->folder.view_all",compact('message','array_sach','array_mon_hoc','array_khoa_hoc'));
			}

		return view ("$this->folder.view_all",compact('array_sach','array_mon_hoc','array_khoa_hoc'));
	}

	public function view_so_luong_sach_nhap()
	{
		$array_chuyen_nganh = ChuyenNganh::all();

		$array_khoa_hoc = KhoaHoc::all();

		$ma_chuyen_nganh = Request::get('ma_chuyen_nganh');
		$ma_khoa_hoc = Request::get('ma_khoa_hoc');

		$count_lop = Lop::where('ma_chuyen_nganh','=',$ma_chuyen_nganh)
						->where('ma_khoa_hoc','=',$ma_khoa_hoc)
						->count();

		$count_sinh_vien = SinhVien::query()
							->join('lop','sinh_vien.ma_lop','=','lop.ma_lop')
							->where('ma_chuyen_nganh','=',$ma_chuyen_nganh)
							->where('ma_khoa_hoc','=',$ma_khoa_hoc)
							->count();

		$count_sach = $count_lop * $count_sinh_vien;

		return view ("$this->folder.view_so_luong_sach_nhap",compact('array_chuyen_nganh','array_khoa_hoc','count_lop','count_sinh_vien','count_sach','ma_chuyen_nganh','ma_khoa_hoc'));		
	}

	public function get_sach_by_lop()
	{
		$ma_lop = Request::get('ma_lop');
		$array_sach = Sach::get_all_by_lop($ma_lop);
		
		return $array_sach;
	}

	public function get_sach_by_chuyen_nganh()
	{
		$ma_chuyen_nganh = Request::get('ma_chuyen_nganh');
		$array_sach = Sach::get_all_by_chuyen_nganh($ma_chuyen_nganh);
		return $array_sach;
	}

	public function process_insert()
	{
		$sach = new Sach();
		$sach->ma_mon_hoc = Request::get('ma_mon_hoc');
		$sach->ten_sach = Request::get('ten_sach');
		$sach->so_luong_nhap = Request::get('so_luong_nhap');
		$sach->ngay_nhap_sach = date("Y-m-d");
		$sach->ngay_het_han = date("Y-m-d",strtotime("+ 14 day"));

		$count = Sach::where('ten_sach','=',$sach->ten_sach)
						->where('ma_mon_hoc','=',$sach->ma_mon_hoc)
						->where('ngay_nhap_sach','=',$sach->ngay_nhap_sach)
						->count();
		if($count == 0) {
			$sach->save();
			return redirect()->route("$this->folder.view_all")->with('success','Đã thêm');
		}
		return redirect()->route("$this->folder.view_all")->with('error','Hôm nay bạn đã thêm sách này rồi vui lòng cập nhật số lượng!');
	}

	public function process_update()
	{
		$ma_sach = Request::get('ma_sach');
		$ma_mon_hoc = Request::get('ma_mon_hoc');
		$ten_sach = Request::get('ten_sach');
		$so_luong_nhap = Request::get('so_luong_nhap');
		// $sach->ngay_nhap_sach = Request::get('ngay_nhap_sach');
		// $sach->ngay_het_han = Request::get('ngay_het_han');
		
			Sach::where('ma_sach','=',$ma_sach)
					->update(['ma_mon_hoc' => $ma_mon_hoc,
							'ten_sach' => $ten_sach,
							'so_luong_nhap' => $so_luong_nhap,
							// 'ngay_nhap_sach' => $ngay_nhap_sach,							
							// 'ngay_het_han' => $ngay_het_han,							
						]);
			return redirect()->route("$this->folder.view_all")->with('success','Cập nhật thành công');
	}

	public function get_one()
	{
		$ma_sach = Request::get('ma_sach');
		$sach = Sach::where('ma_sach','=',$ma_sach)->first();
		
		return Response::json($sach);
	}
}