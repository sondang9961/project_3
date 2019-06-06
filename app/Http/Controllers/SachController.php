<?php
namespace App\Http\Controllers;

use Request;
use App\Model\Sach;

class SachController extends Controller
{
	public function view_all()
	{
		$array_sach = Sach::get_all();
		return view ('sach.view_all',['array_sach' => $array_sach]);
	}
}