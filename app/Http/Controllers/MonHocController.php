<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Request;
use Response;
use App\Model\MonHoc;
use App\Model\ChuyenNganh;
use App\Exports\MonHocExport;
use Excel;
use PDF;

class MonHocController extends Controller
{
	private $folder = 'mon_hoc';
	public function view_all()
	{
		$array_chuyen_nganh = ChuyenNganh::all();

		$array_mon_hoc = MonHoc::query()
							->join('chuyen_nganh','mon_hoc.ma_chuyen_nganh','=','chuyen_nganh.ma_chuyen_nganh')
							->orderBy('ma_mon_hoc','desc')->paginate(5);
		$search = Input::get('search');
		if($search != ''){
			$array_mon_hoc = MonHoc::query()
								->join('chuyen_nganh','mon_hoc.ma_chuyen_nganh','=','chuyen_nganh.ma_chuyen_nganh')
								->where('ten_mon_hoc','LIKE','%'.$search.'%')
								->orWhere('ten_chuyen_nganh','LIKE','%'.$search.'%')
								->orderBy('ma_mon_hoc','desc')
								->paginate(5);
			$array_mon_hoc->appends(array('search' => Input::get('search')));
			if(count($array_mon_hoc) > 0){
				return view("$this->folder.view_all",compact('array_mon_hoc','array_chuyen_nganh'));
			}
			$message = "Không tìm thấy kết quả";
			return view("$this->folder.view_all",compact('message','array_mon_hoc','array_chuyen_nganh'));
		}
		else {
			return view("$this->folder.view_all",compact('array_mon_hoc','array_chuyen_nganh'));
		}
	}

	public function get_mon_hoc_by_chuyen_nganh()
	{
		$ma_chuyen_nganh = Request::get('ma_chuyen_nganh');
		$array_mon_hoc = MonHoc::get_all_by_chuyen_nganh($ma_chuyen_nganh);
		return $array_mon_hoc;
	}

	public function process_insert()
	{
		$mon_hoc = new MonHoc();
		$mon_hoc->ten_mon_hoc = Request::get('ten_mon_hoc');
		$mon_hoc->ma_chuyen_nganh = Request::get('ma_chuyen_nganh');

		$count = MonHoc::where('ten_mon_hoc','=',$mon_hoc->ten_mon_hoc)
						->where('ma_chuyen_nganh','=',$mon_hoc->ma_chuyen_nganh)
						->count();
		if($count == 0) {
			$mon_hoc->save();
			return redirect()->route("$this->folder.view_all")->with('success','Đã thêm');
		}
		return redirect()->route("$this->folder.view_all")->with('error','Môn học đã tồn tại!');
		
	}

	public function process_update()
 	{
 		$ma_mon_hoc = Request::get('ma_mon_hoc');
 		$ten_mon_hoc = Request::get('ten_mon_hoc');
		$ma_chuyen_nganh = Request::get('ma_chuyen_nganh');

		$count = MonHoc::where('ten_mon_hoc','=',$ten_mon_hoc)
						->where('ma_chuyen_nganh','=',$ma_chuyen_nganh)
						->count();
		if($count == 0) {
			MonHoc::where('ma_mon_hoc','=',$ma_mon_hoc)
					->update(['ten_mon_hoc' => $ten_mon_hoc,'ma_chuyen_nganh' => $ma_chuyen_nganh]);
			return redirect()->route("$this->folder.view_all")->with('success','Cập nhật thành công');
		}
		return redirect()->route("$this->folder.view_all")->with('error','Môn học đã tồn tại!');
 	}	

 	public function get_one()
	{
		$ma_mon_hoc = Request::get('ma_mon_hoc');
		$mon_hoc = MonHoc::where('ma_mon_hoc','=',$ma_mon_hoc)->first();
		return Response::json($mon_hoc);
	}

	public function export()
	{
		return Excel::download(new MonHocExport, 'danh_sach_mon_hoc.xlsx');
	}

	public function view_pdf()
	{
		$array_mon_hoc = MonHoc::query()->join('chuyen_nganh','mon_hoc.ma_chuyen_nganh','=','chuyen_nganh.ma_chuyen_nganh')->get();
        
        return view("$this->folder.view_pdf",compact('array_mon_hoc'));
	}

	public function export_pdf()
	{
		$pdf = PDF::loadView('mon_hoc.view_pdf');
		return $pdf->download('danh_sach_mon_hoc.pdf');
	}

	

}