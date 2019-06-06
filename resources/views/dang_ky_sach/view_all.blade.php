@extends('view_trang_chu')
@section('content')
	<center>
		<div>
			<h1>Đăng ký sách</h1>
			<form>
				<div><h2>Danh sách sinh viên đăng ký sách</h2></div>
				<table border="1">
					<tr>
						<th>Mã đăng ký</th>
						<th>Tên sinh viên</th>
						<th>Tên sách</th>
						<th>Tình trạng</th>
						<th>Ngày đăng ký sách</th>
						<th>Ngày nhận sách</th>						
					</tr>
					@foreach ($array_dang_ky_sach as $dang_ky_sach)
					<tr>
						<td>{{$dang_ky_sach->ma_dang_ky}}</td>
						<td>{{$dang_ky_sach->ten_sinh_vien}}</td>
						<td>{{$dang_ky_sach->ten_sach}}</td>
						<td>{{$dang_ky_sach->tinh_trang_nhan_sach}}</td>
						<td>{{$dang_ky_sach->ngay_dang_ky}}</td>
						<td>{{$dang_ky_sach->ngay_nhan_sach}}</td>
					</tr>
					@endforeach
				</table>		
			</form>
		</div>
	</center>
@endsection