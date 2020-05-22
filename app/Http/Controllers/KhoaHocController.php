<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Request;
use Response;
use App\Model\KhoaHoc;

class KhoaHocController extends Controller
{
	private $folder = 'khoa_hoc';
	public function view_all(Request $req)
	{
		$array_khoa_hoc = KhoaHoc::query()->orderBy('ma_khoa_hoc','desc')->paginate(2);

		$ten_khoa_hoc = Input::get('ten_khoa_hoc');
		if($ten_khoa_hoc != '' ){
			$array_khoa_hoc = KhoaHoc::where('ten_khoa_hoc','LIKE','%'.$ten_khoa_hoc.'%')
									->orderBy('ma_khoa_hoc','desc')
									->paginate(1);
			$array_khoa_hoc->appends(array('ten_khoa_hoc' => Input::get('ten_khoa_hoc')));
			if(count($array_khoa_hoc) > 0){
				return view("$this->folder.view_all",compact('array_khoa_hoc'));
			}

			$message = "Không tìm thấy khóa học!";
			return view("$this->folder.view_all",compact('message'));
		}
		else {
			return view("$this->folder.view_all",compact('array_khoa_hoc'));
		}
	}

	public function process_insert()
	{
		$khoa_hoc = new KhoaHoc();
		$khoa_hoc->ten_khoa_hoc = Request::get('ten_khoa_hoc');

		$count = KhoaHoc::where('ten_khoa_hoc','=',$khoa_hoc->ten_khoa_hoc)->count();

		if($count == 0){
			$khoa_hoc->save();
			return redirect()->route("$this->folder.view_all")->with('success', 'Đã thêm');
		}
		//điều hướng
		return redirect()->route("$this->folder.view_all")->with('error', 'Khóa học đã tồn tại');
	}

	public function process_update()
	{
		$ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$ten_khoa_hoc = Request::get('ten_khoa_hoc');

		$count = KhoaHoc::where('ten_khoa_hoc','=',$ten_khoa_hoc)->count();

		if($count == 0){
			KhoaHoc::where('ma_khoa_hoc','=',$ma_khoa_hoc)
					->update(['ten_khoa_hoc' => $ten_khoa_hoc]);
			return redirect()->route("$this->folder.view_all")->with('upd_success', 'Cập nhật thành công');
		}
		//điều hướng
		return redirect()->route("$this->folder.view_all")->with('upd_error', 'Khóa học đã tồn tại');

	}
	public function get_one()
	{
		$ma_khoa_hoc = Request::get('ma_khoa_hoc');
		$khoa_hoc = KhoaHoc::where('ma_khoa_hoc','=',$ma_khoa_hoc)->first();
		
		return Response::json($khoa_hoc);
	}
}