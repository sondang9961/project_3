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
							@if ($trang > 1)
								<button type="button" onclick="location.href='{{ route('sinh_vien.danh_sach_sinh_vien_by_lop',[
										'trang' => 1,
										'ma_lop' => $ma_lop
									]) }}'" 				
								>
									Đầu
								</button>
								<button type="button" onclick="location.href='{{ route('sinh_vien.danh_sach_sinh_vien_by_lop',[
										'trang' => $prev, 
										'ma_lop' => $ma_lop
									]) }}'" style="font-weight:bold; color: black" >
									<
								</button>
							@endif
							@if ($count_trang > 7)
								@for ($i = $startpage; $i <= $endpage; $i++)
									<button type="button" onclick="location.href='{{ route('sinh_vien.danh_sach_sinh_vien_by_lop',[
											'trang' => $i,
											'ma_lop' => $ma_lop
										]) }}'" 
										@if ($trang==$i)
											style="background-color: grey; color: white"
										@endif
									>
										{{$i}}
									</button>
								@endfor
							@else
								@for ($i = 1; $i <= $count_trang; $i++)
									<button type="button" onclick="location.href='{{ route('sinh_vien.danh_sach_sinh_vien_by_lop',[
										'ma_lop' => $lop->ma_lop,
										'trang' => $i]) }}'"
										@if ($trang==$i)
											style="background-color: grey; color: white"
										@endif
										>
										{{$i}}
									</button>
								@endfor
							@endif
							@if ($trang < $count_trang)
								<button type="button" onclick="location.href='{{ route('sinh_vien.danh_sach_sinh_vien_by_lop',[
										'trang' => $next, 
										'ma_lop' => $ma_lop
										]) }}'" style="font-weight:bold; color: black" >
									>
								</button>
								<button type="button" onclick="location.href='{{ route('sinh_vien.danh_sach_sinh_vien_by_lop',[
										'trang' => $count_trang, 
										'ma_lop' => $ma_lop
										]) }}'">
									Cuối
								</button>
							@endif 
							
						</td>
					</tr>
				</tfoot>
			</table>
			<button onclick="location.href='{{route('lop.view_all')}}'">Quay lại</button>
		</div>
	</div>
@endsection