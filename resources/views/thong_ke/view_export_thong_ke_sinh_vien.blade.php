<center>
	<h3>Danh sách sinh viên chưa đăng ký sách {{$ten_sach[0]->ten_sach}} lớp {{$array_thong_ke_sinh_vien[0]->ten_lop}}
	</h3>
</center>
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
		@foreach ($array_thong_ke_sinh_vien as $thong_ke)
			<tr>
				<td>{{$thong_ke->ma_sinh_vien}}</td>
				<td>{{$thong_ke->ten_sinh_vien}}</td>
				<td>{{date_format(date_create($thong_ke->ngay_sinh),'d/m/Y')}}</td>
				<td>{{$thong_ke->email}}</td>
				<td>{{$thong_ke->sdt}}</td>
				<td>{{$thong_ke->dia_chi}}</td>
				<td>{{$thong_ke->ten_lop}}</td>
			</tr>
		@endforeach
	</tbody>
</table>