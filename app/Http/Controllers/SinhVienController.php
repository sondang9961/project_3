<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;

use Sofa\Eloquence\Subquery;
use Illuminate\Http\Request;
use Response;
use App\Model\SinhVien;
use App\Model\DangKySach;
use App\Model\Lop;
use Excel;
use App\Imports\SinhVienImport;
use App\Exports\SinhVienExport;
use Exception;
use PDF;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}
class SinhVienController extends Controller
{
	private $folder='sinh_vien';
	public function view_all(Request $request)
	{
		$array_lop = Lop::all();

		$search = Input::get('search');
	
		$array_sinh_vien = SinhVien::query()->join('lop','sinh_vien.ma_lop','=','lop.ma_lop');
		if($search != ''){
			$array_sinh_vien = $array_sinh_vien->where('ten_sinh_vien','LIKE','%'.$search.'%')
				->orWhere('ten_lop','LIKE','%'.$search.'%');
		}
		$array_sinh_vien = $array_sinh_vien->orderBy('ma_sinh_vien','desc')->paginate(5);

		$array_sinh_vien->appends(array('search' => Input::get('search')));
		
		if(count($array_sinh_vien) > 0){
			return view("$this->folder.view_all",compact('array_sinh_vien','array_lop','search'));
		}
		$message = "Không tìm thấy kết quả";
		return view("$this->folder.view_all",compact('message','array_sinh_vien','array_lop','search'));
	
	}

	public function get_sinh_vien_by_lop(Request $request)
	{
		$ma_lop = $request->get('ma_lop');
		$array_sinh_vien = SinhVien::get_sinh_vien_by_lop($ma_lop);
		return $array_sinh_vien;
	}

	public function process_insert(Request $request)
	{
		$sinh_vien = new SinhVien();
		$sinh_vien->ten_sinh_vien = $request->get('ten_sinh_vien');
		$sinh_vien->ngay_sinh = $request->get('ngay_sinh');
		$sinh_vien->email = $request->get('email');
		$sinh_vien->sdt = $request->get('sdt');
		$sinh_vien->dia_chi = $request->get('dia_chi');
		$sinh_vien->ma_lop = $request->get('ma_lop');
		$sinh_vien->save();

		return redirect()->route("$this->folder.view_all")->with('success','Đã thêm');

	}

	public function process_update(Request $request)
	{
		$ma_sinh_vien = $request->get('ma_sinh_vien');
		$ten_sinh_vien = $request->get('ten_sinh_vien');
		$ngay_sinh = $request->get('ngay_sinh');
		$email = $request->get('email');
		$sdt = $request->get('sdt');
		$dia_chi = $request->get('dia_chi');
		$ma_lop = $request->get('ma_lop');
	
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
		$ma_sinh_vien = $request->get('ma_sinh_vien');
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

	public function export()
	{
		return Excel::download(new SinhVienExport, 'danh_sach_sinh_vien.xlsx');
	}

	public function delete_process($ma_sinh_vien)
	{
		$sinh_vien = SinhVien::where('ma_sinh_vien','=',$ma_sinh_vien);

		$dang_ky_sach = DangKySach::where('ma_sinh_vien','=',$ma_sinh_vien);

		$dang_ky_sach->delete();
		$sinh_vien->delete();

		return back()->with('delete', 'Đã xóa sinh viên');
	}

	public function export_pdf(Request $request)
	{
		$search = $request->get('search');

		$array_sinh_vien = SinhVien::query()->join('lop','sinh_vien.ma_lop','=','lop.ma_lop');
		if(isset($search)){
			$array_sinh_vien = $array_sinh_vien->where('ten_sinh_vien','LIKE','%'.$search.'%')
				->orWhere('ten_lop','LIKE','%'.$search.'%');
		}
		$array_sinh_vien = $array_sinh_vien->get();

		$pdf = PDF::loadView("$this->folder.view_pdf", ['array_sinh_vien' => $array_sinh_vien]);
		return $pdf->download('danh_sach_sinh_vien.pdf');
	}
}