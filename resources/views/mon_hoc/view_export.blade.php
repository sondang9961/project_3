<center>
	<h3>Danh sách môn học</h3>

</center>
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