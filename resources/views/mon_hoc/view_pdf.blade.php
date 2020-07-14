<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Danh sách môn học</title>
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
		<h3>Danh sách môn học</h3>
		<table class="table table-striped" border="1" cellspacing="0">
			<thead>
				<tr>
					<th>Mã</th>
					<th>Tên môn học</th>
					<th>Chuyên ngành</th>
				</tr>
			</thead>	
			<tbody>
				@foreach ($array_mon_hoc as $mon_hoc)
					<tr>
						<td>{{$mon_hoc->ma_mon_hoc}}</td>
						<td>{{$mon_hoc->ten_mon_hoc}}</td>
						<td>{{$mon_hoc->ten_chuyen_nganh}}</td>			
					</tr>
				@endforeach
			</tbody>
		</table>
	</center>
</body>
</html>

