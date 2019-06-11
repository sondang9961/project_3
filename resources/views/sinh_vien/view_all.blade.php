@extends('view_trang_chu')
@section('content')
	<center><h1>Quản lý sinh viên</h1></center>
	<div id="main_content">
		<div id="left_content">
			<div><h2>Danh sách sinh viên</h2></div>
			<form>
				Lớp
				<select name="ma_lop">
					<option>--Tên lớp--</option>
					@foreach($array_lop as $lop)
						<option value="{{$lop->ma_lop}}">
							{{$lop->ten_lop}}
						</option>
					@endforeach
				</select>
				<input type="submit" value="Xem">
			</form>
			<br>
			<table border="1">
				<tr>
					<th>Mã</th>
					<th>Tên sinh viên</th>
					<th>Tên lớp</th>
					<th colspan="2">Chức năng</th>
				</tr>
				@foreach ($array_sinh_vien as $sinh_vien)
				<tr>
					<td>{{$sinh_vien->ma_sinh_vien}}</td>
					<td>{{$sinh_vien->ten_sinh_vien}}</td>
					<td>{{$sinh_vien->ten_lop}}</td>
					<td><button>Cập nhật</button></td>
					<td><button>Xóa</button></td>					
				</tr>
				@endforeach
			</table>
		</div>
		<div id="right_content" >
			<div><h2>Thêm sinh viên</h2></div>
				<div>
					<form action="{{ route('sinh_vien.process_insert')}}" method="post">
						{{csrf_field()}}
						<div>Tên sinh viên</div>	
						<div><input type="text" name="ten_sinh_vien" id="textbox"></div><br>
						<div>Tên lớp</div>
						<div>
							<select name="ma_lop">
								<option>--Tên lớp--</option>
								@foreach($array_lop as $lop)
									<option value="{{$lop->ma_lop}}">
										{{$lop->ten_lop}}
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