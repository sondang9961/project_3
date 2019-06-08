@extends('view_trang_chu')
@section('content')
<center>
	<h1>Quản lý đăng ký sách</h1>
</center>
	<div id="main-content">
		<div id="left_content">
			<div><h2>Danh sách sinh viên đăng ký sách</h2></div>
			<form>
				<table>
					<tr>
						<td>
							Tên khóa học 
						</td>
						<td>
							<select>
								<option>--Tên khóa học--</option>
						</select>
						</td>
						<td>
							Tên môn
						</td>
						<td>
							<select>
								<option>--Tên môn--</option>
						</select>
						</td>						
					</tr>
					<tr>
						<td>
							Tên lớp 
						</td>
						<td>
							<select>
								<option>--Tên lớp--</option>
						</select>
						</td>
						<td>
							Tên sách 
						</td>
						<td>
							<select>
								<option>--Tên sách--</option>
						</select>
						</td>						
					</tr>
					<tr>
						<td><input type="button" value="Xem"></td>
					</tr>
				</table>
			</form>
			 <br/>
			<table border="1">
				<tr>
					<th>Mã đăng ký</th>
					<th>Tên sinh viên</th>
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
		</div>
		<div id="right_content" >
			<div><h2>Đăng ký sách</h2></div>
				<div>
					<form>
						<table width="80%">
							<tr>
								<td>
									<div>Khóa học</div>
									<div>
										<select>
											<option>--Khóa học--</option>
										</select>
									</div>
								</td>
								<td>
									<div>Tên lớp</div>
									<div>
										<select>
											<option>--Lớp--</option>
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div>Tên môn</div>
									<div>
										<select>
											<option>--Môn học--</option>
										</select>
									</div>
								</td>
								<td>
									<div>Tên sinh viên</div>
									<div>
										<select>
											<option>--tên sinh viên--</option>
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div>Tên sách</div>	
									<div>
										<select name="ma_sach">
											<option>--tên sách--</option>
										</select>
									</div>
									<br>
							<div><input type="button" value="Thêm" id="button"></div>
						</table>
					</form>
				</div>
		</div>
	</div>

@endsection