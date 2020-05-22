<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Sofa\Eloquence\Subquery;
use Request;
use Response;
use App\Model\Lop;
use App\Model\KhoaHoc;
use App\Model\SinhVien;

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
		$countSinhVien = new \Sofa\Eloquence\Subquery(
		    SinhVien::from('sinh_vien')
		        ->selectRaw('count(*)')->whereRaw('ma_lop = lop.ma_lop'), 
		    'sy_so'
		);

		$array_lop = Lop::from('lop')
					        ->select('*', $countSinhVien)
					        ->addBinding($countSinhVien->getBindings(), 'select')
					        ->join('khoa_hoc','lop.ma_khoa_hoc','=','khoa_hoc.ma_khoa_hoc')
					        ->orderBy('ma_lop','desc')
							->paginate(5);
		$search = Input::get('search');
		if($search != ''){
			$array_lop = Lop::from('lop')
				        ->select('*', $countSinhVien)
				        ->addBinding($countSinhVien->getBindings(), 'select')
				        ->join('khoa_hoc','lop.ma_khoa_hoc','=','khoa_hoc.ma_khoa_hoc')
						->where('ten_lop','LIKE','%'.$search.'%')
						->orWhere('ten_khoa_hoc','LIKE','%'.$search.'%')
						->orderBy('ma_lop','desc')
						->paginate(5);
			$array_lop->appends(array('search' => Input::get('search')));
			if(count($array_lop) > 0){
				return view("$this->folder.view_all",compact('array_lop','array_khoa_hoc'));
			}
			$message = "Không tìm thấy lớp, khóa học!";
			return view("$this->folder.view_all",compact('message','array_lop','array_khoa_hoc'));
		}
		else {
			return view("$this->folder.view_all",compact('array_lop','array_khoa_hoc'));
		}
	}
	
	public function get_lop_by_khoa_hoc()
	{
		$lop = new Lop();
		$lop->ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$array_lop = $lop->get_all_by_khoa_hoc();
		return $array_lop;
	}

	public function process_insert()
	{
		$lop = new Lop();
		$lop->ten_lop = Request::get('ten_lop');
		$lop->ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$array_lop = $lop->check_insert();
		if (count($array_lop) == 0) {
			$lop->insert();
			return redirect()->route("$this->folder.view_all")->with('success', 'Đã thêm');
		}
		return redirect()->route("$this->folder.view_all")->with('error', 'Lớp đã tồn tại !'); 
		
	}

	public function process_update($ma_lop)
	{
		$lop = new Lop();
		$lop->ma_lop = Request::get('ma_lop');
		$lop->ten_lop = Request::get('ten_lop');
		$lop->ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$lop->updateLop();

		//điều hướng
		return redirect()->route("$this->folder.view_all"); 
	}

	public function process_search()
	{
		$lop = new Lop();
		$lop->ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$array_search_lop = $lop->process_search();

		//điều hướng
		return redirect()->route("$this->folder.view_all"); 
	}

	public function get_one()
	{
		$lop = new Lop();
		$lop->ma_lop = Request::get('ma_lop');
		$lop = $lop->get_one();
		
		return Response::json($lop);
	}
}