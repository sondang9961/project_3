@extends('layer.master')
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
				<input type="submit" value="Xem" id="button">
			</form>
			<br>
			<table class="table table-striped">
				<tr>
					<th>Mã</th>
					<th>Tên sinh viên</th>
					<th>Tên lớp</th>
					<th colspan="2">Chức năng</th>
				</tr>
				@foreach ($array_sinh_vien as $sinh_vien)
				<tr>
					<td>{{$sinh_vien->ma_sinh_vien}}</td>
					<td><input type="text" name="ten_sinh_vien" value="{{$sinh_vien->ten_sinh_vien}}" size="15"></td>
					<td>
						<select name="ma_lop">
							@foreach($array_lop as $lop)
								<option value="{{$lop->ma_lop}}" 
									<?php if($sinh_vien->ma_lop == $lop->ma_lop) echo "selected"; ?>>
									{{$lop->ten_lop}}
								</option>
							@endforeach
						</select>
					</td>
					<td><button style="width:100%">Cập nhật</button></td>				
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