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
					<td><input type="text" name="ten_khoa_hoc" value="{{$khoa_hoc->ten_khoa_hoc}}"></td>
					<td>
						<a href="{{route('khoa_hoc.process_update')}}">
						<button style="width: 100%">Cập nhật</button>
						</a>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		<div id="right_content" >
			<div><h2>Thêm khóa học</h2></div>
				<div>
					<form action="{{route('khoa_hoc.process_insert')}}" method="post">
						{{csrf_field()}}
						<div>Tên khóa học</div>	
						<div><input type="text" name="ten_khoa_hoc" id="textbox"></div><br>
						<div><input type="submit" value="Thêm" id="button"></div>
					</form>
				</div>
		</div>
	</div>
@endsection