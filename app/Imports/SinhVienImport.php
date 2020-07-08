<?php

namespace App\Imports;

use App\Model\SinhVien;
use App\Model\Lop;
use Maatwebsite\Excel\Concerns\ToModel;

class SinhVienImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
         $data = [
            'ten_sinh_vien'       => $row['ten_sinh_vien'],
            // select ma from lop where ten = 'BKD' limit 1
            // if not exist insert into lop(ten) values ('BKD')
            // select ma from lop where ten = 'BKD' limit 1
            'ma_lop'    => $row['ma_lop']
        ];

        return new SinhVien($data);
    }
}
