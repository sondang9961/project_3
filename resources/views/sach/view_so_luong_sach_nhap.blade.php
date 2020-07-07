@extends('layer.master')
@section('pageTitle', 'Số lượng sách cần nhập')
@push('css')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
	<div class="card">
		<h2 style="padding: 1%">Thống kê số sách cần nhập mỗi khóa theo chuyên ngành</h2>
		<div class="content">
			<div class="toolbar">
				<form>
					<table>
						<tr>
							<td style="padding-bottom: 4%">
								<div style="margin-right: 3rem ">Tên chuyên ngành
									<select name="ma_chuyen_nganh" class="form-control" style="width: 20rem" id="search_lop">
										<option selected disabled>--Tên chuyên ngành--</option>
										@foreach ($array_chuyen_nganh as $chuyen_nganh)
											<option value="{{$chuyen_nganh->ma_chuyen_nganh}}"
											@if ($chuyen_nganh->ma_chuyen_nganh == $ma_chuyen_nganh)
												selected 
											@endif		
											>
												{{$chuyen_nganh->ten_chuyen_nganh}}
											</option>
										@endforeach
									</select>
								</div>
							</td>
							<td style="padding-bottom: 4%">
								<div style="margin-right: 3rem ">Niên khóa 
									<select name="ma_khoa_hoc" class="form-control" style="width: 14rem" id="searchSach">
										<option selected disabled>--Tên khóa--</option> 
										@foreach ($array_khoa_hoc as $khoa_hoc)
											<option value="{{$khoa_hoc->ma_khoa_hoc}}"
												@if ($khoa_hoc->ma_khoa_hoc == $ma_khoa_hoc)
													selected 
												@endif		
												>
												{{$khoa_hoc->ten_khoa_hoc}}
											</option>
										@endforeach
									</select>
								</div>
							</td>
							<td style="padding-bottom: 5%">
								<input type="submit" class="btn btn-info btn-round btn-sm btn-fill" value="Thống kê"style="margin-left: 5px">
							</td>
						</tr>
					</table>
				</form>
				@if (isset($ma_chuyen_nganh) && isset($ma_khoa_hoc))
					<table>
						<tr>
							<td><h4>Số lớp của khóa là:</h4></td>
							<td style="padding-left: 8px"><h4><b>{{$count_lop}}</b> lớp</h4></td>
						</tr>
						<tr>
							<td><h4>Số sinh viên mỗi lớp là:</h4></td>
							<td style="padding-left: 8px"><h4><b>{{$count_sinh_vien}}</b> sinh viên</h4></td>
						</tr>
						<tr>
							<td><h4>Số sách cần nhập là:</h4></td>
							<td style="padding-left: 8px"><h4><b>{{$count_sach}}</b> quyển sách</h4></td>
						</tr>
					</table>
				@endif
				<button class='button_update btn btn-info btn-fill btn-wd center-block' onclick="location.href='{{ route('sach.view_all') }}'">Quay lại</button>
			</div>

		</div>
	</div>
@endsection
@push('js')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
	$("#search_lop").select2();
	$("#searchSach").select2();
</script>
@endpush

