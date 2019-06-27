@extends('layer.master')
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
	.div_hide {
		display: none;
	}
</style>
@endpush
@section('content')
<center><h1>Quản lý sách</h1></center>
	<div id="main_content">
		<div id="left_content">
			<div><h2>Danh sách các đầu sách</h2></div>
			<form>
				<table style="width: 100%">
					<tr style="height: 4rem">
						<div>
							<td>
								Tên môn
							</td>
							<td>
								<select name="ma_mon_hoc" class="form-control" style="width: 14rem" id="search_mon_hoc">
									<option disabled selected>--Môn học--</option>
									@foreach ($array_mon_hoc as $mon_hoc)
										<option value="{{$mon_hoc->ma_mon_hoc}}">
											{{$mon_hoc->ten_mon_hoc}}
										</option>
									@endforeach
								</select>
							</td>
						</div>
						<div>
							<td>
								Tên sách
							</td>
							<td>
								<select name="ma_sach" class="form-control" style="width: 14rem" id="search_sach" disabled>
									<option>--Sách--</option>
								</select>
							</td>
						</div>				
						<td><input type="submit" value="Xem" id="button" class="search_button" disabled></td>
					</tr>
			</form>
			<br>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Mã</th>
						<th>Tên sách</th>
						<th>Môn</th>
						<th>Số lượng</th>
						<th>Ngày nhập</th>
						<th>Ngày hết hạn đăng ký</th>
						<th>Chức năng</th>
					</tr>
				</thead>				
				@foreach ($array_sach as $sach)
				<tr>
					<td>{{$sach->ma_sach}}</td>
					<td>{{$sach->ten_sach}}</td>
					<td>{{$sach->ten_mon_hoc}}</td>
					<td>{{$sach->so_luong_nhap}}</td>
					<td>{{$sach->ngay_nhap_sach}}</td>
					<td>{{$sach->ngay_het_han}}</td>
					<td>
						<input type="submit" value="Cập nhật">
					</td>
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
					<div class="form-group">
						<div>Tên môn</div>
						<select name="ma_mon_hoc" class="form-control" style="width: 25rem" id="select_mon_hoc" disabled>
							<option>--Môn học--</option>
						</select>
					</div><br>
					<div class="form-group" >
						<div>Tên sách</div>	
						<div><input type="text" name="ten_sach" id="ten_sach" class="form-control" style="width: 25rem"  disabled></div>
					</div>
					<div class="form-group ">
						<div>Số lượng</div>	
						<div>
							<input type="number" name="so_luong_nhap" id="so_luong" class="form-control" style="width: 25rem" disabled>
						</div>
					</div>	
					<br>	
					<div><input type="submit" value="Thêm" id="button" class="add_button" disabled></div>
				</form>
			</div>
		</div>
	</div>
@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$("#select_khoa_hoc").select2();
		$("#select_khoa_hoc").change(function(){
			$("#select_mon_hoc").val(null).trigger('change');
			$("#select_mon_hoc").attr("disabled", false);
			$("#ten_sach").attr("disabled", true);
			$("#so_luong").attr("disabled", true);
			$(".add_button").attr("disabled", true);
		});
		$("#select_mon_hoc").change(function(){
			$("#ten_sach").val(null).trigger('change');
			$("#ten_sach").attr("disabled", false);
			$("#so_luong").attr("disabled", true);
			$(".add_button").attr("disabled", true);
		})
		$("#ten_sach").change(function(){		
			$("#so_luong").val(null).trigger('change');
			$("#so_luong").attr("disabled", false);
			$(".add_button").attr("disabled", true);

		})
		$("#so_luong").change(function(){
			if($("#so_luong").val()==null)
			{
				$(".add_button").attr("disabled", true);
			}
			else{
				$(".add_button").attr("disabled", false);
			}	
		})
		
		$("#demoForm").validate({
			ignore: [], 
			rules: {
				"so_luong_nhap": {
					required: true,
					range: [0,500]
				}
			}
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

		//Search
		$("#search_mon_hoc").select2();
		$("#search_mon_hoc").change(function(){
			$("#search_sach").attr("disabled", false);
			$("#search_sach").val(null).trigger('change');	
			$(".search_button").attr("disabled", true);	
		})

		$("#search_sach").change(function(){
			$(".search_button").attr("disabled", false);	
		})
		$("#search_sach").select2({
			ajax: {
				url: '{{route('get_sach_by_mon_hoc')}}',
				dataType: 'json',
				data: function() {
					ma_mon_hoc = $("#search_mon_hoc").val();
					return {
						ma_mon_hoc: ma_mon_hoc
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