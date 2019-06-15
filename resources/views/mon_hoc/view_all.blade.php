@extends('layer.master')
@section('content')
	<center><h1>Quản lý môn học</h1></center>
	<div id="main_content">
		<div id="left_content">
			<div><h2>Danh sách môn học</h2></div>
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
					<th>Tên môn</th>
					<th>Khóa học</th>
					<th colspan="2">Chức năng</th>
				</tr>
				@foreach ($array_mon_hoc as $mon_hoc)
				<tr>
					<td>{{$mon_hoc->ma_mon_hoc}}</td>
					<td><input type="text" name="ten_mon_hoc" value="{{$mon_hoc->ten_mon_hoc}}" size="10"></td>
					<td>
						<select name="ma_khoa_hoc">
							@foreach($array_khoa_hoc as $khoa_hoc)
								<option value="{{$khoa_hoc->ma_khoa_hoc}}"  <?php if($mon_hoc->ma_khoa_hoc == $khoa_hoc->ma_khoa_hoc) echo "selected"; ?>>
									{{$khoa_hoc->ten_khoa_hoc}}
								</option>
							@endforeach
						</select>
					</td>
					<td><button style="width:100%">Cập nhật</button></td>
				</tr>
				@endforeach
			</table>
		</div>
		<div id="right_content">
			<div><h2>Thêm môn học</h2></div>
				<div>
					<form action="{{route('mon_hoc.process_insert')}}" method="post">
						{{csrf_field()}}
						<div>Tên môn</div>	
						<div><input type="text" name="ten_mon_hoc" id="textbox"></div><br>
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