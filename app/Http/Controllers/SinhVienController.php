<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;

use Sofa\Eloquence\Subquery;
use Illuminate\Http\Request;
use Response;
use App\Model\SinhVien;
use App\Model\Lop;
use Excel;
use App\Imports\SinhVienImport;
use Exception;

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
		$array_lop = Lop::all();

		$array_sinh_vien = SinhVien::query()
							->join('lop','sinh_vien.ma_lop','=','lop.ma_lop')
							->orderBy('ma_sinh_vien','desc')->paginate(5);

		$search = Input::get('search');
		if($search != ''){
			$array_sinh_vien = SinhVien::query()
								->join('lop','sinh_vien.ma_lop','=','lop.ma_lop')
								->where('ten_sinh_vien','LIKE','%'.$search.'%')
								->orWhere('ten_lop','LIKE','%'.$search.'%')
								->orderBy('ma_sinh_vien','desc')
								->paginate(5);
			$array_sinh_vien->appends(array('search' => Input::get('search')));
			if(count($array_sinh_vien) > 0){
				return view("$this->folder.view_all",compact('array_sinh_vien','array_lop'));
			}
			$message = "Không tìm thấy kết quả";
			return view("$this->folder.view_all",compact('message','array_sinh_vien','array_lop'));
		}
		else {
			return view("$this->folder.view_all",compact('array_sinh_vien','array_lop'));
		}
	}

	public function get_sinh_vien_by_lop()
	{
		$ma_lop = Request::get('ma_lop');
		$array_sinh_vien = SinhVien::get_all_by_lop($ma_lop);
		return $array_sinh_vien;
	}

	public function process_insert()
	{
		$sinh_vien = new SinhVien();
		$sinh_vien->ten_sinh_vien = Request::get('ten_sinh_vien');
		$sinh_vien->ngay_sinh = Request::get('ngay_sinh');
		$sinh_vien->email = Request::get('email');
		$sinh_vien->sdt = Request::get('sdt');
		$sinh_vien->dia_chi = Request::get('dia_chi');
		$sinh_vien->ma_lop = Request::get('ma_lop');
		$sinh_vien->save();

		return redirect()->route("$this->folder.view_all")->with('success','Đã thêm');

	}

	public function process_update()
	{
		$ma_sinh_vien = Request::get('ma_sinh_vien');
		$ten_sinh_vien = Request::get('ten_sinh_vien');
		$ngay_sinh = Request::get('ngay_sinh');
		$email = Request::get('email');
		$sdt = Request::get('sdt');
		$dia_chi = Request::get('dia_chi');
		$ma_lop = Request::get('ma_lop');
	
		SinhVien::where('ma_sinh_vien','=',$ma_sinh_vien)
				->update([
						'ten_sinh_vien' => $ten_sinh_vien,
						'ngay_sinh' => $ngay_sinh,
						'email' => $email,
						'sdt' => $sdt,
						'dia_chi' => $dia_chi,
						'ma_lop' => $ma_lop]);
			
		return redirect()->route("$this->folder.view_all")->with('success','Cập nhật thành công');
	}

	public function danh_sach_sinh_vien_by_lop($ma_lop)
	{
		$countSinhVien = new \Sofa\Eloquence\Subquery(
		    SinhVien::from('sinh_vien')
		        ->selectRaw('count(*)')->where('ma_lop', '=', $ma_lop), 
		    'sy_so'
		);

		$array_sinh_vien = SinhVien::from('sinh_vien')
							    ->select('*', $countSinhVien)
						        ->addBinding($countSinhVien->getBindings(), 'select')
						        ->join('lop','lop.ma_lop','=','sinh_vien.ma_lop')
								->where('sinh_vien.ma_lop','=',$ma_lop)
								->orderBy('ma_sinh_vien','desc')
								->paginate(5);
		return view("$this->folder.danh_sach_sinh_vien_by_lop",compact('array_sinh_vien'));
	}

	public function get_one(Request $request)
	{
		$ma_sinh_vien = $request->has('ma_sinh_vien');
		$sinh_vien = SinhVien::where('ma_sinh_vien','=',$ma_sinh_vien)->first();		
		return Response::json($sinh_vien);
	}

	public function view_import_excel()
	{
		return view("$this->folder.view_import_excel");
	}

	public function import(Request $request)
	{
		try {
			$file = $request->file('select_file')->path();

			Excel::import(new SinhVienImport, $file);

			return back()->with('import_success', 'Tải lên thành công.');
		} 
		catch (Exception $e) {
			return back()->with('import_fail', 'Tải lên không thành công.');
		}
		
	}
}