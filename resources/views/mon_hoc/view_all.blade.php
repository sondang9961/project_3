@extends('view_trang_chu')
@section('content')
<link rel="stylesheet" type="text/css" href="../../public/css/style.css" />
	<center><h1>Quản lý môn học</h1></center>
	<div id="main_content">
		<div id="left_content">
			<div><h2>Danh sách môn học</h2></div>
			<table border="1">
				<tr>
					<th>Mã</th>
					<th>Tên môn</th>
					<th>Khóa học</th>
					<th>Chức năng</th>
				</tr>
				@foreach ($array_mon_hoc as $mon_hoc)
				<tr>
					<td>{{$mon_hoc->ma_mon_hoc}}</td>
					<td>{{$mon_hoc->ten_mon_hoc}}</td>
					<td>{{$mon_hoc->ten_khoa_hoc}}</td>
					<td><button>Sửa</button></td>
				</tr>
				@endforeach
			</table>
		</div>
		<div id="right_content">
			<div><h2>Thêm môn học</h2></div>
				<div>
					<form>
						<div>Tên môn</div>	
						<div><input type="text" name="ten_mon" id="textbox"></div><br>
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