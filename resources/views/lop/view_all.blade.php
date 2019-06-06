@extends('view_trang_chu')
@section('content')
	<div id="main_content">
		<div id="left_content" >
			<div>
				<h2>Danh sách lớp</h2>
			</div>
			<table border="1">
				<tr>
					<th>Mã</th>
					<th>Tên lớp</th>
					<th>Khóa học</th>
					<th>Chức năng</th>
				</tr>
				@foreach ($array_lop as $lop)
				<tr>
					<td>{{$lop->ma_lop}}</td>
					<td>{{$lop->ten_lop}}</td>
					<td>{{$lop->ten_khoa_hoc}}</td>
					<td>Sửa</td>
				</tr>
				@endforeach
			</table>
		</div>
		<div id="right_content">
			<div><h2>Thêm lớp</h2></div>
				<div>
					<form>
						<div>Tên lớp</div>	
						<div><input type="text" name="ten_lop" id="textbox"></div><br>
						<div>Khóa học</div>
						<div>
							<select>
								<option>--Tên khóa học--</option>
							</select>
						</div><br>
						<div><input type="button" value="Thêm" id="button"></div>
					</form>
				</div>
		</div>
	</div>
@endsection