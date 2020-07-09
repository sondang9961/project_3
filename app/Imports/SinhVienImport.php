<?php

namespace App\Imports;

use App\Model\SinhVien;
use App\Model\Lop;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;

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
            'ngay_sinh'     => date_format(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_sinh']), 'Y-m-d'),
            'email'         => $row['email'],
            'sdt'           => $row['sdt'],
            'dia_chi'       => $row['dia_chi'],
            'ma_lop'        => Lop::where(['ten_lop' => $row['lop']])->value('ma_lop')
        ];

        return new SinhVien($data);
    }
}
