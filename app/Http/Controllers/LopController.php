<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Sofa\Eloquence\Subquery;
use Request;
use Response;
use App\Model\Lop;
use App\Model\KhoaHoc;
use App\Model\ChuyenNganh;
use App\Model\SinhVien;
use App\Exports\LopExport;
use Excel;
use PDF;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}
class LopController extends Controller
{
	private $folder = 'lop';
	public function view_all()
	{
		$array_khoa_hoc = KhoaHoc::all();
		$array_chuyen_nganh = ChuyenNganh::all();
		$countSinhVien = new \Sofa\Eloquence\Subquery(
		    SinhVien::from('sinh_vien')
		        ->selectRaw('count(*)')->whereRaw('ma_lop = lop.ma_lop'), 
		    'sy_so'
		);

		$search = Input::get('search');
	
		$array_lop = Lop::from('lop')
			        ->select('*', $countSinhVien)
			        ->addBinding($countSinhVien->getBindings(), 'select')
			        ->join('khoa_hoc','lop.ma_khoa_hoc','=','khoa_hoc.ma_khoa_hoc')
			        ->join('chuyen_nganh','lop.ma_chuyen_nganh','=','chuyen_nganh.ma_chuyen_nganh');
		if($search != ''){		
			$array_lop = $array_lop->where('ten_lop','LIKE','%'.$search.'%')
				->orWhere('ten_khoa_hoc','LIKE','%'.$search.'%')
				->orWhere('ten_chuyen_nganh','LIKE','%'.$search.'%');
		}

		$array_lop = $array_lop->orderBy('ma_lop','desc')->paginate(5);
		
		$array_lop->appends(array('search' => Input::get('search')));
		if(count($array_lop) > 0){
			return view("$this->folder.view_all",compact('array_lop','array_khoa_hoc','array_chuyen_nganh','search'));
		}
		$message = "Không tìm thấy kết quả";
		return view("$this->folder.view_all",compact('message','array_lop','array_khoa_hoc','array_chuyen_nganh','search'));
	}
	
	public function get_lop_by_chuyen_nganh()
	{
		$ma_chuyen_nganh = Request::get('ma_chuyen_nganh');
		$array_lop = Lop::get_all_by_chuyen_nganh($ma_chuyen_nganh);
		return $array_lop;
	}

	public function process_insert()
	{
		$lop = new Lop();
		$lop->ten_lop = Request::get('ten_lop');
		$lop->ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$lop->ma_chuyen_nganh = Request::get('ma_chuyen_nganh');
		
		$count = Lop::where('ten_lop','=',$lop->ten_lop)->count()
					->where('ma_khoa_hoc','=',$ma_khoa_hoc)
					->where('ma_chuyen_nganh','=',$ma_chuyen_nganh)->count();

		if($count == 0) {
			$lop->save();
			return redirect()->route("$this->folder.view_all")->with('success','Đã thêm');
		}
		return redirect()->route("$this->folder.view_all")->with('error','Lớp đã tồn tại!');
	}

	public function process_update()
	{
		$ma_lop = Request::get('ma_lop');
		$ten_lop = Request::get('ten_lop');
		$ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$ma_chuyen_nganh = Request::get('ma_chuyen_nganh');

		$count = Lop::where('ten_lop','=',$ten_lop)
					->where('ma_khoa_hoc','=',$ma_khoa_hoc)
					->where('ma_chuyen_nganh','=',$ma_chuyen_nganh)->count();

		if($count == 0) {
			Lop::where('ma_lop','=',$ma_lop)
				->update([
							'ten_lop' => $ten_lop,
							'ma_khoa_hoc' => $ma_khoa_hoc,
							'ma_chuyen_nganh' => $ma_chuyen_nganh
						]);
			return redirect()->route("$this->folder.view_all")->with('success','Cập nhật thành công');
		} 
		return redirect()->route("$this->folder.view_all")->with('error','Lớp đã tồn tại!');
	}

	public function get_one()
	{
		$ma_lop = Request::get('ma_lop');
		$lop = Lop::where('ma_lop','=',$ma_lop)->first();
		return Response::json($lop);
	}

	public function export()
	{
		return Excel::download(new LopExport, 'danh_sach_lop.xlsx');
	}

	public function export_pdf()
	{
		$countSinhVien = new \Sofa\Eloquence\Subquery(
		    SinhVien::from('sinh_vien')
		        ->selectRaw('count(*)')->whereRaw('ma_lop = lop.ma_lop'), 
		    'sy_so'
		);

		$search = Request::get('search');
	
		$array_lop = Lop::from('lop')
			        ->select('*', $countSinhVien)
			        ->addBinding($countSinhVien->getBindings(), 'select')
			        ->join('khoa_hoc','lop.ma_khoa_hoc','=','khoa_hoc.ma_khoa_hoc')
			        ->join('chuyen_nganh','lop.ma_chuyen_nganh','=','chuyen_nganh.ma_chuyen_nganh');
		if(isset($search)){		
			$array_lop = $array_lop->where('ten_lop','LIKE','%'.$search.'%')
				->orWhere('ten_khoa_hoc','LIKE','%'.$search.'%')
				->orWhere('ten_chuyen_nganh','LIKE','%'.$search.'%');
		}

		$array_lop = $array_lop->get();

	    $pdf = PDF::loadView("$this->folder.view_pdf", ['array_lop' => $array_lop, 'search' => $search]);
		return $pdf->download('danh_sach_lop.pdf');
	}
}