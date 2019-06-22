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
	static function getButtonTinhTrang($ma_tinh_trang,$ma_dang_ky)
	{
		switch ($ma_tinh_trang) {
			case '1':
				$button = "
				<button class='button_tinh_trang' data-tinh_trang_nhan_sach='0' data-ma_dang_ky='$ma_dang_ky'>
						Chưa nhận
				</button>";
				return $button;
				break;
			case '0':
				$button = "
				<button class='button_tinh_trang' data-tinh_trang_nhan_sach='1' data-ma_dang_ky='$ma_dang_ky'>
						Đã nhận
				</button>";
				return $button;
				break;
		}
	}
}