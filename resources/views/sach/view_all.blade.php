@extends('layer.master')
@push('css')
<style type="text/css">
	.div_hide{
		display: none;
	}
</style>
@endpush
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<center><h1>Quản lý sách</h1></center>
	<div id="main_content">
		<div id="left_content">
			<div><h2>Danh sách các đầu sách</h2></div>
			<table class="table table-striped">
				<tr>
					<th>Mã</th>
					<th>Tên sách</th>
					<th>Tên môn</th>
					<th>Số lượng nhập</th>
					<th>Ngày nhập sách</th>
					<th>Ngày hết hạn đăng ký</th>
					<th>Chức năng</th>
				</tr>
				@foreach ($array_sach as $sach)
				<tr>
					<td></td>
				</tr>
				@endforeach
			</table>
		</div>
		<div id="right_content" >
			<div><h2>Thêm sách</h2></div>
				<div>
					<form action="{{route('sach.process_insert')}}" method="post" > 
						{{csrf_field()}}
						<div class="form-group">
							<div>Tên khóa học</div>
							<select name="ma_khoa_hoc" class="form-control" style="width: 25rem" id="select_khoa_hoc">
								<option disabled selected>--Chọn khóa học--</option>
								@foreach ($array_khoa_hoc as $khoa_hoc)
									<option value="{{$khoa_hoc->ma_khoa_hoc}}">
										{{$khoa_hoc->ten_khoa_hoc}}
									</option>
								@endforeach
							</select>
						</div><br>
						<div class="div_hide" id="div_mon_hoc">
							<div>Tên môn</div>
							<select name="ma_mon_hoc" class="form-control" style="width: 25rem" id="select_mon_hoc">
								<option>--Môn học--</option>
								@foreach ($array_mon_hoc as $mon_hoc)
									<option value="{{$mon_hoc->ma_mon_hoc}}">
										{{$mon_hoc->ten_mon_hoc}}
									</option>
								@endforeach
							</select>
						</div><br>
						<div>Tên sách</div>	
						<div><input type="text" name="ten_sach" id="textbox" class="form-control" style="width: 25rem"></div><br>	
						<div>Số lượng</div>	
						<div><input type="number" name="so_luong_nhap" id="textbox" class="form-control" style="width: 25rem"></div><br>	
						<div><input type="button" value="Thêm" id="button"></div>
					</form>
				</div>
		</div>
	</div>
@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#select_khoa_hoc").select2();
		$("#select_khoa_hoc").change(function(){
			$("#div_mon_hoc").show();
			$("#select_mon_hoc").val(null).trigger('change');
		})
		$("#select_mon_hoc").select2({
			ajax: {
				url: '{{route('get_mon_hoc_by_khoa_hoc')}}',
				dataType: 'json', 
				data: function() {
					ma_khoa_hoc = $("#select_khoa_hoc").val();
					return {
						ma_khoa_hoc: ma_khoa_hoc
					}
				},
				processResults: function (data){
					return {
						results: $.map(data, function(item) {
							return  {
								text: item.ten_mon_hoc,
								id: item.ma_mon_hoc 
							}
						})
					};
				}
			}
		});
	});
</script>
@endpush

