@extends('layer.master')
@section('content')
<center><h1>Quản lý lớp</h1></center>
	<div id="main_content">
		<div id="left_content" >
			<div><h2>Danh sách lớp</h2></div>
			<form>
				Khóa học
				<select name="ma_khoa_hoc">
					<option>--Tên khóa học--</option>
					@foreach($array_khoa_hoc as $khoa_hoc)
						<option value="{{$khoa_hoc->ma_khoa_hoc}}">
							{{$khoa_hoc->ten_khoa_hoc}}
						</option>
					@endforeach
				</select>
				<input type="submit" value="Xem" id="button">
			</form>
			<br>
			<table class="table table-striped">
				<tr>
					<th>Mã</th>
					<th>Tên lớp</th>
					<th>Khóa học</th>
					<th colspan="2">Chức năng</th>
				</tr>
				@foreach ($array_lop as $lop)
				<tr>
					<td>{{$lop->ma_lop}}</td>
					<td><input type="text" name="ten_lop" value="{{$lop->ten_lop}}" size="10"></td>
					<td >
						<select>
							@foreach($array_khoa_hoc as $khoa_hoc)
								<option value="{{$khoa_hoc->ma_khoa_hoc}}" <?php if($lop->ma_khoa_hoc == $khoa_hoc->ma_khoa_hoc) echo "selected"; ?>>
									{{$khoa_hoc->ten_khoa_hoc}}
								</option>
							@endforeach
						</select>					
					</td>
					<td><button style="width:100%">Cập nhật</button></td>
					<td><button style="width:100%">Danh sách sinh viên</button></td>
				</tr>
				@endforeach
			</table>
		</div>
		<div id="right_content">
			<div><h2>Thêm lớp</h2></div>
				<div>
					<form action="{{ route('lop.process_insert')}}" method="post" id="form_insert">
						{{csrf_field()}}
						<div>Tên lớp</div>	
						<div><input type="text" name="ten_lop" id="textbox"></div><br>
						<div>Khóa học</div>
						<div>
							<select name="ma_khoa_hoc" id="ma_khoa_hoc">
								<option value="-1">--Tên khóa học--</option>
								@foreach ($array_khoa_hoc as $khoa_hoc) 
									<option value="{{$khoa_hoc->ma_khoa_hoc}}">
										{{$khoa_hoc->ten_khoa_hoc}}
									</option>
								@endforeach 								
							</select>
						</div><br>
						<div><input type="button" onclick="validate()" value="Thêm" id="button"></div>
					</form>
				</div>
		</div>
	</div>
@endsection