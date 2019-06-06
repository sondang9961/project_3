@extends('view_trang_chu')
@section('content')
	<center><h1>Quản lý khóa học</h1></center>
	<div id="main_content">
		<div id="left_content">
			<div><h2>Danh sách khóa học</h2></div>
			<table border="1">
				<tr>
					<th>Mã</th>
					<th>Tên khóa học</th>
					<th>Chức năng</th>
				</tr>
				@foreach ($array_khoa_hoc as $khoa_hoc)
				<tr>
					<td>{{$khoa_hoc->ma_khoa_hoc}}</td>
					<td>{{$khoa_hoc->ten_khoa_hoc}}</td>
					<td><button>Sửa</button></td>
				</tr>
				@endforeach
			</table>
		</div>
		<div id="right_content" >
			<div><h2>Thêm khóa học</h2></div>
				<div>
					<form>
						<div>Tên khóa học</div>	
						<div><input type="text" name="ten_khoa_hoc" id="textbox"></div><br>
						<div><input type="button" value="Thêm" id="button"></div>
					</form>
				</div>
		</div>
	</div>
@endsection