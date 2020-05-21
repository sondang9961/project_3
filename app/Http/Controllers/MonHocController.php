<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Request;
use Response;
use App\Model\MonHoc;
use App\Model\KhoaHoc;

class MonHocController extends Controller
{
	private $folder = 'mon_hoc';
	public function view_all()
	{
		$array_khoa_hoc = KhoaHoc::all();

		$array_mon_hoc = MonHoc::query()
							->join('khoa_hoc','mon_hoc.ma_khoa_hoc','=','khoa_hoc.ma_khoa_hoc')
							->orderBy('ma_mon_hoc','desc')->paginate(5);
		$search = Input::get('search');
		if($search != ''){
			$array_mon_hoc = MonHoc::query()
								->join('khoa_hoc','mon_hoc.ma_khoa_hoc','=','khoa_hoc.ma_khoa_hoc')
								->where('ten_mon_hoc','LIKE','%'.$search.'%')
								->orWhere('ten_khoa_hoc','LIKE','%'.$search.'%')
								->orderBy('ma_mon_hoc','desc')
								->paginate(5);
			$array_mon_hoc->appends(array('search' => Input::get('search')));
			if(count($array_mon_hoc) > 0){
				return view("$this->folder.view_all",compact('array_mon_hoc','array_khoa_hoc'));
			}
			$message = "Không tìm thấy môn, khóa học!";
			return view("$this->folder.view_all",compact('message','array_mon_hoc','array_khoa_hoc'));
		}
		else {
			return view("$this->folder.view_all",compact('array_mon_hoc','array_khoa_hoc'));
		}
	}

	public function get_mon_hoc_by_khoa_hoc()
	{

		$ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$array_mon_hoc = MonHoc::get_all_by_khoa_hoc($ma_khoa_hoc);
		return $array_mon_hoc;
	}

	public function process_insert()
	{
		$mon_hoc = new MonHoc();
		$mon_hoc->ten_mon_hoc = Request::get('ten_mon_hoc');
		$mon_hoc->ma_khoa_hoc = Request::get('ma_khoa_hoc');

		$count = MonHoc::where('ten_mon_hoc','=',$mon_hoc->ten_mon_hoc)
						->where('ma_khoa_hoc','=',$mon_hoc->ma_khoa_hoc)
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
		$ma_khoa_hoc = Request::get('ma_khoa_hoc');

		$count = MonHoc::where('ten_mon_hoc','=',$ten_mon_hoc)
						->where('ma_khoa_hoc','=',$ma_khoa_hoc)
						->count();
		if($count == 0) {
			MonHoc::where('ma_mon_hoc','=',$ma_mon_hoc)
					->update(['ten_mon_hoc' => $ten_mon_hoc,'ma_khoa_hoc' => $ma_khoa_hoc]);
			return redirect()->route("$this->folder.view_all")->with('success','Cập nhật thành công');
		}
		return redirect()->route("$this->folder.view_all")->with('error','Môn học đã tồn tại!');
 	}	

 	public function get_one()
	{
		$mon_hoc = new MonHoc();
		$mon_hoc->ma_mon_hoc = Request::get('ma_mon_hoc');
		$mon_hoc = $mon_hoc->get_one();
		
		return Response::json($mon_hoc);
	}
}