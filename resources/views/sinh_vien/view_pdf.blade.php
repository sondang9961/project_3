<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Danh sách sinh viên</title>
	<style>
		.page-break {
		    page-break-after: always;
		}
		body{
			font-family: DejaVu Sans;
		}
	</style>
</head>
<body>
	<center><h3>Danh sách sinh viên</h3>
		<table class="table table-striped" border="1" cellspacing="0">
			<thead>
				<tr>
					<th>Mã</th>
					<th>Tên sinh viên</th>
					<th>Ngày sinh</th>
					<th>Email</th>
					<th>Số điện thoại</th>
					<th>Địa chỉ</th>
					<th>Tên lớp</th>
				</tr>
			</thead>	
			<tbody>
				@foreach ($array_sinh_vien as $sinh_vien)
					<tr>
						<td>{{$sinh_vien->ma_sinh_vien}}</td>
						<td>{{$sinh_vien->ten_sinh_vien}}</td>
						<td>{{date_format(date_create($sinh_vien->ngay_sinh),'d/m/Y')}}</td>
						<td>{{$sinh_vien->email}}</td>
						<td>{{$sinh_vien->sdt}}</td>
						<td>{{$sinh_vien->dia_chi}}</td>
						<td>{{$sinh_vien->ten_lop}}</td>			
					</tr>
				@endforeach
			</tbody>
		</table>
	</center>
</body>
</html>
