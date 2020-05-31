@extends('layer.master')
@section('pageTitle', 'Thống kê sách')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/daterangepicker.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
	<div class="card">
		<h2 style="padding: 1%">Thống kê sách</h2>	
		<div class="content">
			<div class="toolbar">
				<form>
					<table>
						<tr>
							<td style="padding-bottom: 4%">
								<div style="margin-right: 3rem ">Tìm kiếm<br>
									<input type="text" name="search" placeholder="sách, môn học" value="{{ Request::get('search') }}" style="height: 3.8rem">
								</div>
							</td>
							<td style="padding-bottom: 4%">
								Ngày nhập
								<table>
									<tr>
										<td>
											Từ &nbsp
										</td>
										<td>
											<input type="date" name="start" class="form-control">
										</td>
										<td>&nbsp đến &nbsp</td>
										<td>
											<input type="date" name="end" class="form-control">	
										</td>
									</tr>
								</table>
							</td>
							<td >
								<input type="submit" class="btn btn-round btn-sm btn-fill" value="Xem"style="margin-left: 5px">
							</td>
							<td>
								<input type="button" class="btn btn-info btn-round btn-sm btn-fill" value="Hiện tất cả" onclick="location.href='{{ route('thong_ke.view_thong_ke_sach') }}'" style="margin-left: 5px">
							</td>
						</tr>
					</table>			
				</form>
			</div>
			@if(count($array_thong_ke_sach) > 0)
			<table class="table table-striped">
				<tr>
					<th>Tên sách</th>
					<th>Ngày nhập</th>
					<th>Số lượng nhập</th>
					<th>Số lượng đã phát</th>
					<th>Số lượng tồn kho</th>
				</tr>
				@foreach ($array_thong_ke_sach as $thong_ke)
					<tr>
						<td>{{$thong_ke->ten_sach}}</td>
						<td>{{date_format(date_create($thong_ke->ngay_nhap_sach),'d/m/Y')}}</td>
						<td>{{$thong_ke->so_luong_nhap}}</td>
						<td>{{$thong_ke->so_luong_da_phat}}</td>
						<td>{{$thong_ke->so_luong_ton_kho}}</td>
					</tr>
				@endforeach
				<tfoot>
					<tr>
						<td colspan="100%"> 
							{!! $array_thong_ke_sach->render()!!}
						</td>
					</tr>
				</tfoot>
			</table>
			@else
				{{ $message }}	
			@endif
		</div>
	</div>

@endsection
@push('js')
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/daterangepicker.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#search_lop").select2();
		$("#search_lop").change(function(){
			$("#searchSach").val(null).trigger('change');
			$("#searchSach").attr("disabled", false);
		})
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
								text: item.ten_sach,
								id: item.ma_sach
							}
						})
					};
				}
			}
		});		
	});

	// $(function() {
	// 	$('input[name="start"]','input[name="end"]').daterangepicker({
	// 	    opens: 'left'
	// 	}, function(start, end, label) {
	// 		console.log("A new date selection was made: " + start.date_format('D-M-Y') + ' to ' + end.date_format('D-M-Y'));
	// 	});
	// });
</script>
@endpush