@extends('layer.master')
@section('content')
	<div id="main_content">
		<div id="left_content">
			@foreach ($array_lop as $lop)
			@endforeach
			<center><h2>Danh sách sinh viên lớp {{$lop->ten_lop}}</h2></center>
			<table class="table table-striped">
				<tr>
					<th>Mã</th>
					<th>Tên sinh viên</th>
					<th>Tên lớp</th>
				</tr>
				@foreach ($array_sinh_vien as $sinh_vien)
				<tr>
					<td>{{$sinh_vien->ma_sinh_vien}}</td>
					<td>{{$sinh_vien->ten_sinh_vien}}</td>
					<td>{{$sinh_vien->ten_lop}}</td>			
				</tr>
				@endforeach
			</table>
			<button onclick="location.href='{{route('lop.view_all')}}'">Quay lại</button>
		</div>
	</div>
@endsection