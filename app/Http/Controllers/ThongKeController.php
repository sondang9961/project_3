<?php
namespace App\Http\Controllers;

use Request;
use App\Model\ThongKe;
use App\Model\Lop;
use App\Model\Sach;

class ThongKeController extends Controller
{
	private $folder = 'thong_ke';
	public function view_all()
	{
		$lop = new lop();
		$array_lop = $lop->get_all_lop();

		$sach = new Sach();
		$array_sach = $sach->get_all();

		return view("$this->folder.view_all",[
			'array_lop' => $array_lop,
			'array_sach' => $array_sach
		]);
	}
}