@extends('layer.master')
@section('pageTitle', 'Thống kê sinh viên')
@push('css')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
	<div class="card">	
		<h2 style="padding: 1%">Thống kê sinh viên chưa đăng ký sách</h2>
		<div class="content">
			<div class="toolbar">
				<form>
					<table>
						<tr>
							<td style="padding-bottom: 4%">
								<div style="margin-right: 3rem ">Tên lớp
									<select name="ma_lop" class="form-control" style="width: 14rem" id="search_lop">
										<option selected disabled>--Tên lớp--</option>
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
							<td style="padding-bottom: 4%">
								<div style="margin-right: 3rem ">Tên sách
									<select name="ma_sach" class="form-control" style="width: 14rem" id="searchSach">
										<option selected disabled>--Tên sách--</option> 
										@foreach ($array_sach as $sach)
											<option value="{{$sach->ma_sach}}"
												@if ($sach->ma_sach == $ma_sach)
													selected 
												@endif		
												>
												{{$sach->ten_sach}}
											</option>
										@endforeach
									</select>
								</div>
							</td>
							<td style="padding-bottom: 5%">
								<input type="submit" class="btn btn-round btn-sm btn-fill" value="Xem"style="margin-left: 5px">
							</td>
						</tr>
					</table>
				</form>
			</div>
			@if (count($array_thong_ke_sinh_vien) > 0)
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Mã</th>
							<th>Tên sinh viên</th>
							<th>Lớp</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($array_thong_ke_sinh_vien as $thong_ke)
							<tr>
								<td>{{$thong_ke->ma_sinh_vien}}</td>
								<td>{{$thong_ke->ten_sinh_vien}}</td>
								<td>{{$thong_ke->ten_lop}}</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td colspan="100%">
								{!! $array_thong_ke_sinh_vien->render()!!}
							</td>
						</tr>
					</tfoot>
				</table>
			@endif			
		</div>
	</div>

@endsection
@push('js')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#search_lop").select2();
		$("#searchSach").select2({
			ajax: {
				url: '{{route('get_sach_by_lop')}}',
				dataType: 'json',
				data: function() {
					ma_lop = $("#search_lop").val();
					return {
						ma_lop: ma_lop
					}
				},
				processResults: function (data){
					return {
						results: $.map(data, function(item) {
							return  {
								text: `${item.ten_sach} (${formatDate(item.ngay_nhap_sach)})`,
								id: item.ma_sach
							}
						})
					};
				}
			}
		});		
	});
</script>
@endpush