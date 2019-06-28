@extends('layer.master')
@section('content')
<center>
	<h1>Thống kê</h1>
</center>
	<div id="main_content">	
		<div id="thong_ke_sach">
			<div><h2>Thống kê sách</h2></div>
			<form>
				<table>
					<tr>
						<td >
							<div style="margin-right: 3rem ">Tên sách
								<select name="ma_sach" class="form-control" style="width: 14rem" id="search_sach">
									<option selected disabled="">--Tên sách--</option>
									@foreach ($array_sach as $sach)
										<option value="{{$sach->ma_sach}}">
											{{$sach->ten_sach}}
										</option>
									@endforeach
								</select>
							</div>
						</td>
						<td>
							<div>
								Ngày nhập
								<input type="date" name="ngay_nhap_sach" class="form-control">
							</div>
						</td>
						<td valign="bottom">
							<input type="button" value="Xem" id="button">
						</td>
					</tr>
				</table>				
			</form><br>
			<table class="table table-striped">
				<tr>
					<th>Tên sách</th>
					<th>Số lượng nhập</th>
					<th>Số lượng đã phát</th>
					<th>Số lượng tồn kho</th>
					<th>Ngày nhập</th>
				</tr>
			</table>
		</div>
		<div id="thong_ke_sinh_vien" >
			<div><h2>Thống kê sinh viên chưa đăng ký sách</h2></div>
			<form>
				<table>
					<tr>
						<td>
							<div style="margin-right: 3rem ">Tên lớp
								<select name="ma_sach" class="form-control" style="width: 14rem" id="search_lop">
									<option selected disabled="">--Tên lớp--</option>
									@foreach ($array_lop as $lop)
										<option value="{{$lop->ma_lop}}">
											{{$lop->ten_lop}}
										</option>
									@endforeach
								</select>
							</div>
						</td>
						<td>
							<div style="margin-right: 3rem ">Tên sách
								<select name="ma_sach" class="form-control" style="width: 14rem" id="search_sach">
									<option selected disabled="">--Tên sách--</option>
									@foreach ($array_sach as $sach)
										<option value="{{$sach->ma_sach}}">
											{{$sach->ten_sach}}
										</option>
									@endforeach
								</select>
							</div>
						</td>
						<td valign="bottom">
							<input type="button" value="Xem" id="button">
						</td>
					</tr>
				</table>
			</form><br>
			<table class="table table-striped">
				<tr>
					<th>Mã</th>
					<th>Tên sinh viên</th>
					<th>Lớp</th>
					<th>Tình trạng</th>
				</tr>
			</table>
		</div>
	</div>

@endsection