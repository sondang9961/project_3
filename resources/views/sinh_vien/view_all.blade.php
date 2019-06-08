@extends('view_trang_chu')
@section('content')
	<center><h1>Quản lý sinh viên</h1></center>
	<div id="main_content">
		<div id="left_content">
			<div><h2>Danh sách sinh viên</h2></div>
			<form>
				Lớp
				<select>
					<option>-- Tên lớp --</option>
				</select>
				<input type="submit" value="Xem">
			</form>
			<br>
			<table border="1">
				<tr>
					<th>Mã</th>
					<th>Tên sinh viên</th>
					<th>Tên lớp</th>
					<th>Chức năng</th>
				</tr>
				@foreach ($array_sinh_vien as $sinh_vien)
				<tr>
					<td>
						
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		<div id="right_content" >
			<div><h2>Thêm sinh viên</h2></div>
				<div>
					<form>
						<div>Tên sinh viên</div>	
						<div><input type="text" name="ten_sinh_vien" id="textbox"></div><br>
						<div>Tên lớp</div>
						<div>
							<select>
								<option>--Tên lớp--</option>
							</select>
						</div><br>
						<div><input type="button" value="Thêm" id="button"></div>
					</form>
				</div>
		</div>
	</div>
@endsection