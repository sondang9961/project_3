<center><h3>Danh sách lớp</h3></center>
<table class="table table-striped" border="1" cellspacing="0">
	<thead>
		<tr>
			<th>Mã</th>
			<th>Tên lớp</th>
			<th>Khóa học</th>
			<th>Chuyên ngành</th>
			<th>Sỹ số</th>
		</tr>
	</thead>	
	<tbody>
		@foreach ($array_lop as $lop)
			<tr>
				<td>{{$lop->ma_lop}}</td>
				<td>{{$lop->ten_lop}}</td>
				<td>{{$lop->ten_khoa_hoc}}</td>
				<td>{{$lop->ten_chuyen_nganh}}</td>
				<td>{{$lop->sy_so}}</td>			
			</tr>
		@endforeach
	</tbody>
</table>