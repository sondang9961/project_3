@extends('layer.master')
@section('content')
	<div id="main_content">
		<div id="left_content">
			@foreach ($array_lop as $lop)
			@endforeach
			<center><h2>Danh sách sinh viên lớp {{$lop->ten_lop}}</h2></center>
			@foreach ($array_sinh_vien_by_lop as $sinh_vien)
			@endforeach
			<h6>Sỹ số: {{$sinh_vien->sy_so}}</h6>	
			<table class="table table-striped">
				<tr>
					<th>Mã</th>
					<th>Tên sinh viên</th>
					<th>Tên lớp</th>
				</tr>
				@foreach ($array_sinh_vien_by_lop as $sinh_vien)
				<tr>
					<td>{{$sinh_vien->ma_sinh_vien}}</td>
					<td>{{$sinh_vien->ten_sinh_vien}}</td>
					<td>{{$sinh_vien->ten_lop}}</td>			
				</tr>
				<tr>			
				@endforeach
				<tfoot>
					<tr>
						<td colspan="100%">
							Trang: 
							@for ($i = 1; $i <= $count_trang; $i++)
								<a href="{{ route('sinh_vien.danh_sach_sinh_vien_by_lop',[
								'ma_lop' => $lop->ma_lop,
								'trang' => $i]) }}"
									@if ($trang==$i)
										style='font-weight: bolder; font-size: 17px'
									@endif
									>
									{{$i}}
								</a>
							@endfor
						</td>
					</tr>
				</tfoot>
			</table>
			<button onclick="location.href='{{route('lop.view_all')}}'">Quay lại</button>
		</div>
	</div>
@endsection