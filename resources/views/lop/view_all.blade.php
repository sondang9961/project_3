@extends('view_trang_chu')
@section('content')
<center><h1>Quản lý lớp</h1></center>
	<div id="main_content">
		<div id="left_content" >
			<div><h2>Danh sách lớp</h2></div>
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
					<td><a href="#" >{{$lop->ten_lop}}</a></td>
					<td>{{$lop->ten_khoa_hoc}}</td>
					<td><button>Cập nhật</button></td>
				</tr>
				@endforeach
			</table>
		</div>
		<div id="right_content">
			<div><h2>Thêm lớp</h2></div>
				<div>
					<form action="{{ route('lop.process_insert')}}" method="post">
						{{csrf_field()}}
						<div>Tên lớp</div>	
						<div><input type="text" name="ten_lop" id="textbox"></div><br>
						<div>Khóa học</div>
						<div>
							<select name="ma_khoa_hoc">
								<option>--Tên khóa học--</option>
								@foreach ($array_khoa_hoc as $khoa_hoc) 
									<option value="{{$khoa_hoc->ma_khoa_hoc}}">
										{{$khoa_hoc->ten_khoa_hoc}}
									</option>
								@endforeach 								
							</select>
						</div><br>
						<div><input type="submit" value="Thêm" id="button"></div>
					</form>
				</div>
		</div>
	</div>
@endsection