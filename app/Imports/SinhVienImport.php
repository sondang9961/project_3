<?php

namespace App\Imports;

use App\Model\SinhVien;
use App\Model\Lop;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SinhVienImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $data = [
            'ten_sinh_vien' => $row['ten_sinh_vien'],

            'ma_lop'        => Lop::firstOrCreate(['ten_lop' => $row['ma_lop']])->ma_lop
        ];

        return new SinhVien($data);
    }
}
