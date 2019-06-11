@extends('view_trang_chu')
@section('content')
<link rel="stylesheet" type="text/css" href="css/style.css" />
<center><h1>Quản lý sách</h1></center>
	<div id="main_content">
		<div id="left_content">
			<div><h2>Danh sách các đầu sách</h2></div>
			<table border="1">
				<tr>
					<th>Mã</th>
					<th>Tên sách</th>
					<th>Tên môn</th>
					<th>Số lượng nhập</th>
					<th>Ngày nhập sách</th>
					<th>Ngày hết hạn đăng ký</th>
					<th>Chức năng</th>
				</tr>
				@foreach ($array_sach as $sach)
				<tr>
					<td></td>
				</tr>
				@endforeach
			</table>
		</div>
		<div id="right_content" >
			<div><h2>Thêm sách</h2></div>
				<div>
					<form action="{{route('sach.process_insert')}}" method="post">
						{{csrf_field()}}			
						<div>Tên môn</div>
						<div>
							<select name="ma_mon_hoc">
								<option>--Môn học--</option>
								@foreach ($array_mon_hoc as $mon_hoc)
									<option value="{{$mon_hoc->ma_mon_hoc}}">
										{{$mon_hoc->ten_mon_hoc}}
									</option>
								@endforeach
							</select>
						</div><br>
						<div>Tên sách</div>	
						<div><input type="text" name="ten_sach" id="textbox"></div><br>	
						<div>Số lượng</div>	
						<div><input type="number" name="so_luong_nhap" id="textbox"></div><br>	
						<div><input type="button" value="Thêm" id="button"></div>
					</form>
				</div>
		</div>
	</div>
@endsection