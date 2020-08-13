<center><h3>Danh sách sinh viên đã đăng ký sách {{$array_dang_ky_sach[0]->ten_sach}} lớp {{$array_dang_ky_sach[0]->ten_lop}}</h3></center>
<table>
	<thead>
		<tr>
			<th>Tên sinh viên</th>
			<th>Lớp</th>
			<th>Tình trạng</th>
			<th>Tên sách</th>
			<th>Ngày đăng ký</th>
			<th>Ngày nhận sách</th>						
		</tr>
	</thead>	
	<tbody>
		@foreach ($array_dang_ky_sach as $dang_ky_sach)
			<tr>
				<td>{{$dang_ky_sach->ten_sinh_vien}}</td>
				<td>{{$dang_ky_sach->ten_lop}}</td>
				<td>
					{!!Helper::getTenTinhTrang($dang_ky_sach->tinh_trang_nhan_sach)!!}
				</td>
				<td>{{$dang_ky_sach->ten_sach}} - {{$dang_ky_sach->ten_khoa_hoc}}</td>
				<td>
					{{date_format(date_create($dang_ky_sach->ngay_dang_ky),'d/m/Y')}}
				</td>
				<td id="ngay_nhan_sach_{{$dang_ky_sach->ma_dang_ky}}">
					@if($dang_ky_sach->tinh_trang_nhan_sach == 1)
						{{date_format(date_create($dang_ky_sach->ngay_nhan_sach),'d/m/Y')}}
					@endif
				</td>
			</tr>
		@endforeach
	</tbody>
</table>