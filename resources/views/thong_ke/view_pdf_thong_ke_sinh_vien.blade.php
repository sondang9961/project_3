<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>
		Danh sách sinh viên chưa đăng ký sách {{$ten_sach[0]->ten_sach}} lớp {{$array_thong_ke_sinh_vien[0]->ten_lop}}
	</title>
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
	<center>
		<h3>Danh sách sinh viên chưa đăng ký sách {{$ten_sach[0]->ten_sach}} lớp {{$array_thong_ke_sinh_vien[0]->ten_lop}}</h3>
		<table class="table table-striped" border="1" cellspacing="0">
			<thead>
				<tr>
					<th>Mã</th>
					<th>Tên sinh viên</th>
					<th>Lớp</th>
				</tr>
			</thead>	
			<tbody>
				@foreach ($array_thong_ke_sinh_vien as $thong_ke)
					<tr>
						<td>{{$thong_ke->ma_sinh_vien}}</td>
						<td>{{$thong_ke->ten_sinh_vien}}</td>
						<td>{{$thong_ke->ten_lop}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</center>
</body>
</html>
