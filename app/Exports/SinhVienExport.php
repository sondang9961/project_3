<?php

namespace App\Exports;

use App\Model\SinhVien;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SinhVienExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('sinh_vien.view_export', [
            'array_sinh_vien' => SinhVien::query()->join('lop','sinh_vien.ma_lop','=','lop.ma_lop')->get()
        ]);
    }
}
