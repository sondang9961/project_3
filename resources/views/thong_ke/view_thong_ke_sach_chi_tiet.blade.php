@extends('layer.master')
@section('pageTitle', 'Thống kê sách chi tiết')
@push('css')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
	<div class="card">
		<h2 style="padding: 1%">Danh sách sinh viên đã nhận sách <b>
			@if(count($array_thong_ke_sach) > 0)
				{{$array_thong_ke_sach[0]->ten_sach}}</b>
			@endif
		 </h2>	
		<div class="content">
			<div class="toolbar">
				<form>
					<input type="hidden" name="ma_sach" value="{{ $ma_sach }}">
					<table>
						<tr>
							<td style="padding-bottom: 4%">
								<div style="margin-right: 3rem ">Tên lớp
									<select name="ma_lop" id="search_lop" class="form-control" style="width: 14rem">
										<option selected disabled>--Tên lớp--</option>
										<option value="">Hiện tất cả</option>
										@foreach ($array_lop as $lop)
											<option value="{{$lop->ma_lop}}"
											@if ($lop->ma_lop == $ma_lop)
												selected 
											@endif		
											>
												{{$lop->ten_lop}}
											</option>
										@endforeach
									</select>
								</div>
							</td>
							<td >
								<input type="submit" class="btn btn-info btn-round btn-sm btn-fill" value="Xem" style="margin-bottom: 11px">
							</td>
						</tr>
					</table>
				</form>
			</div>
			@if(count($array_thong_ke_sach) > 0)
				<table class="table table-striped">
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
						@foreach ($array_thong_ke_sach as $thong_ke)
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
					<tfoot>
						<tr>
							<td colspan="100%"> 
								{!! $array_thong_ke_sach->render()!!}
						</tr>
					</tfoot>
				</table>
			@else
				<center><h4>Chưa có sinh viên nào nhận sách</h4></center>
			@endif
		</div>
	</div>

@endsection
@push('js')
<script src="{{ asset('js/select2.min.js') }}">
	
</script>
<script type="text/javascript">
	$("#search_lop").select2();
</script>
@endpush
