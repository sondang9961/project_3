@extends('layer.master')
@section('content')
<center>
	<h1>Thống kê</h1>
	<div id="main_content">	
		<div id="left_content">
			<div><h2>Thống kê sách</h2></div>
			<form>
				Ngày nhập
					<input type="date" name="ngay_nhap_sach">
				<input type="button" value="Xem" id="button">
			</form><br>
			<table class="table table-striped">
				<tr>
					<th>Tên sách</th>
					<th>Số lượng nhập</th>
					<th>Số lượng đã phát</th>
					<th>Số lượng tồn kho</th>
					<th>Ngày nhập</th>
				</tr>
			</table>
		</div>
		<div id="right_content" >
			<div><h2>Thống kê sinh viên chưa đăng ký sách</h2></div>
			<form>
				Lớp
					<select>
						<option>--Tên lớp--</option>
					</select>
				<input type="button" value="Xem" id="button">
			</form><br>
			<table class="table table-striped">
				<tr>
					<th>Mã</th>
					<th>Tên sinh viên</th>
					<th>Lớp</th>
					<th>Tình trạng</th>
				</tr>
			</table>
		</div>
	</div>
</center>
@endsection