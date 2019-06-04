<?php
namespace App\Http\Controllers;

use Request;
use App\Model\Thong_ke;

class thong_ke_controller extends Controller
{
	public function view_thong_ke()
	{
		$array_thong_ke = Thong_ke::get_all_thong_ke();
		return view ('view_thong_ke',['array_thong_ke' => $array_thong_ke]);
	}
}