<?php 

namespace App;

class Helper
{
	static function getTenTinhTrang($ma_tinh_trang)
	{
		switch ($ma_tinh_trang) {
			case '1':
				return "Đã nhận";
				break;
			case '0':
				return "Chưa nhận";
				break;
		}
	}
	static function getRadioTinhTrang($ma_tinh_trang,$ma_dang_ky)
	{
		$check_tinh_trang_chua_nhan = '';
		$check_tinh_trang_da_nhan = '';
		switch ($ma_tinh_trang) {
			case '0':
				$check_tinh_trang_chua_nhan = "checked";
				break;
			case '1':
				$check_tinh_trang_da_nhan = "checked";
				break;
		}
		// dd($check_tinh_trang_chua_nhan);
		$tinh_trang = "
				<label>
				<input type='radio' name='radio_tinh_trang[$ma_dang_ky]' class='radio_tinh_trang' data-tinh_trang_nhan_sach='0' $check_tinh_trang_chua_nhan data-ma_dang_ky='$ma_dang_ky'>
						Chưa nhận
				</label>
				<label>
				<input type='radio' name='radio_tinh_trang[$ma_dang_ky]' class='radio_tinh_trang' data-tinh_trang_nhan_sach='1' $check_tinh_trang_da_nhan data-ma_dang_ky='$ma_dang_ky'>
						Đã nhận
				</label>";
		return $tinh_trang;
	}
}