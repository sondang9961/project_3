<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Danh sách các đầu sách
		@if (isset($search) && isset($start) && isset($end))
			{{$array_thong_ke_sach[0]->ten_sach}} nhập từ ngày {{date_format(date_create($start),'d/m/Y')}} đến {{date_format(date_create($end),'d/m/Y')}}
		@elseif(isset($search) && isset($start))
			{{$array_thong_ke_sach[0]->ten_sach}} nhập từ ngày {{date_format(date_create($start),'d/m/Y')}}
		@elseif(isset($search) && isset($end))
			{{$array_thong_ke_sach[0]->ten_sach}} nhập đến ngày {{date_format(date_create($end),'d/m/Y')}}
		@elseif(isset($start) && isset($end))
			nhập từ ngày {{date_format(date_create($start),'d/m/Y')}} đến {{date_format(date_create($end),'d/m/Y')}}
		@elseif(isset($start))
			nhập từ ngày {{date_format(date_create($start),'d/m/Y')}}
		@elseif(isset($end))
		 	nhập đến ngày {{date_format(date_create($end),'d/m/Y')}}
	 	@endif
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
		<h3>Danh sách các đầu sách
			@if (isset($search) && isset($start) && isset($end))
			{{$array_thong_ke_sach[0]->ten_sach}} nhập từ ngày {{date_format(date_create($start),'d/m/Y')}} đến {{date_format(date_create($end),'d/m/Y')}}
		@elseif(isset($search) && isset($start))
			{{$array_thong_ke_sach[0]->ten_sach}} nhập từ ngày {{date_format(date_create($start),'d/m/Y')}}
		@elseif(isset($search) && isset($end))
			{{$array_thong_ke_sach[0]->ten_sach}} nhập đến ngày {{date_format(date_create($end),'d/m/Y')}}
		@elseif(isset($start) && isset($end))
			nhập từ ngày {{date_format(date_create($start),'d/m/Y')}} đến {{date_format(date_create($end),'d/m/Y')}}
		@elseif(isset($start))
			nhập từ ngày {{date_format(date_create($start),'d/m/Y')}}
		@elseif(isset($end))
		 	nhập đến ngày {{date_format(date_create($end),'d/m/Y')}}
	 	@endif
		</h3>
		<table class="table table-striped" border="1" cellspacing="0">
			<thead>
				<tr>
					<th>Tên sách</th>
					<th>Ngày nhập</th>
					<th>Số lượng nhập</th>
					<th>Số lượng đã phát</th>
					<th>Số lượng tồn kho</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($array_thong_ke_sach as $thong_ke)
					<tr>
						<td>{{$thong_ke->ten_sach}}</td>
						<td>{{date_format(date_create($thong_ke->ngay_nhap_sach),'d/m/Y')}}</td>
						<td>{{$thong_ke->so_luong_nhap}}</td>
						<td>{{$thong_ke->so_luong_da_phat}}</td>
						<td>{{$thong_ke->so_luong_ton_kho}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</center>
</body>
</html>
