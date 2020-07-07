<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Request;
use Response;
use App\Model\ChuyenNganh;

class ChuyenNganhController extends Controller
{
	private $folder = 'chuyen_nganh';
	public function view_all(Request $req)
	{
		$array_chuyen_nganh = ChuyenNganh::query()->orderBy('ma_chuyen_nganh','desc')->paginate(2);

		$ten_chuyen_nganh = Input::get('ten_chuyen_nganh');
		if($ten_chuyen_nganh != '' ){
			$array_chuyen_nganh = ChuyenNganh::where('ten_chuyen_nganh','LIKE','%'.$ten_chuyen_nganh.'%')
									->orderBy('ma_chuyen_nganh','desc')
									->paginate(1);
			$array_chuyen_nganh->appends(array('ten_chuyen_nganh' => Input::get('ten_chuyen_nganh')));
			if(count($array_chuyen_nganh) > 0){
				return view("$this->folder.view_all",compact('array_chuyen_nganh'));
			}

			$message = "Không tìm thấy kết quả";
			return view("$this->folder.view_all",compact('message'));
		}
		else {
			return view("$this->folder.view_all",compact('array_chuyen_nganh'));
		}
	}

	public function process_insert()
	{
		$chuyen_nganh = new ChuyenNganh();
		$chuyen_nganh->ten_chuyen_nganh = Request::get('ten_chuyen_nganh');

		$count = ChuyenNganh::where('ten_chuyen_nganh','=',$chuyen_nganh->ten_chuyen_nganh)->count();

		if($count == 0){
			$chuyen_nganh->save();
			return redirect()->route("$this->folder.view_all")->with('success', 'Đã thêm');
		}
		//điều hướng
		return redirect()->route("$this->folder.view_all")->with('error', 'Khóa học đã tồn tại');
	}

	public function process_update()
	{
		$ma_chuyen_nganh = Request::get('ma_chuyen_nganh');
		$ten_chuyen_nganh = Request::get('ten_chuyen_nganh');

		$count = ChuyenNganh::where('ten_chuyen_nganh','=',$ten_chuyen_nganh)->count();

		if($count == 0){
			ChuyenNganh::where('ma_chuyen_nganh','=',$ma_chuyen_nganh)
					->update(['ten_chuyen_nganh' => $ten_chuyen_nganh]);
			return redirect()->route("$this->folder.view_all")->with('success', 'Cập nhật thành công');
		}
		//điều hướng
		return redirect()->route("$this->folder.view_all")->with('error', 'Khóa học đã tồn tại');

	}
	public function get_one()
	{
		$ma_chuyen_nganh = Request::get('ma_chuyen_nganh');
		$chuyen_nganh = ChuyenNganh::where('ma_chuyen_nganh','=',$ma_chuyen_nganh)->first();
		
		return Response::json($chuyen_nganh);
	}
}