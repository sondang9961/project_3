@extends('layer.master')
@push('css')
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
	<div id="main_content">	
		<div id="thong_ke_sach">
			<div><h2>Thống kê sách</h2></div>
			<form>
				<table>
					<tr>
						<td >
							<div style="margin-right: 3rem ">Tên sách
								<select name="ma_sach" class="form-control" style="width: 14rem" id="search_sach">
									<option selected disabled="">--Tên sách--</option>
									@foreach ($array_sach as $sach)
										<option value="{{$sach->ma_sach}}">
											{{$sach->ten_sach}}
										</option>
									@endforeach
								</select>
							</div>
						</td>
						<td>
							<div style="margin-right: 3rem ">
								Ngày nhập
								<input type="date" name="ngay_nhap_sach" class="form-control">
							</div>
						</td>
						<td valign="bottom">
							<input type="submit" value="Xem" id="button">
						</td>
					</tr>
				</table>				
			</form><br>
			<table class="table table-striped">
				<tr>
					<th>Tên sách</th>
					<th>Số lượng nhập</th>
					<th>Số lượng đã phát</th>
					<th>Số lượng tồn kho</th>
					<th>Ngày nhập</th>
				</tr>
				@if (isset($array_thong_ke_sach))
					@foreach ($array_thong_ke_sach as $thong_ke)
						<tr>
							<td>{{$thong_ke->ten_sach}}</td>
							<td>{{$thong_ke->so_luong_nhap}}</td>
							<td>{{$thong_ke->so_luong_da_phat}}</td>
							<td>{{$thong_ke->so_luong_ton_kho}}</td>
							<td>{{$thong_ke->ngay_nhap_sach}}</td>
						</tr>
					@endforeach
				@endif
			</table>
		</div>
		

@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
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
</script>
@endpush