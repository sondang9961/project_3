<?php
namespace App\Http\Controllers;

use Request;
use App\Model\ThongKe;

class ThongKeController extends Controller
{
	public function view_all()
	{
		$array_thong_ke = ThongKe::get_all();
		return view ('thong_ke.view_all',['array_thong_ke' => $array_thong_ke]);
	}
}