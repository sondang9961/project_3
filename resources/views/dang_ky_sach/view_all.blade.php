@extends('layer.master')
@push('css')
<style type="text/css">
	.div_hide{
		display: none;
	}
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<center><h1>Quản lý đăng ký sách</h1></center>
	<div id="main-content">
		<div id="left_content">
			<div><h2>Danh sách sinh viên đăng ký sách</h2></div>
			<form>
				<table width="70%">
					<tr style="height: 4rem">
						<div>
							<td>
								Tên khóa học 
							</td>
							<td>
								<select>
									<option>--Tên khóa học--</option>
							</select>
							</td>
						</div>
						<div>
							<td>
								Tên môn
							</td>
							<td>
								<select>
									<option>--Tên môn--</option>
							</select>
							</td>
						</div>													
					</tr>
					<tr>
						<div>
							<td>
								Tên lớp 
							</td>
							<td>
								<select>
									<option>--Tên lớp--</option>
								</select>
							</td>
						</div>
						<div>
							<td>
								Tên sách 
							</td>
							<td>
								<select>
									<option>--Tên sách--</option>
							</select>
							</td>						
						</div>
					</tr>
					<tr>
						<td><input type="button" value="Xem" id="button"></td>
					</tr>
				</table>
			</form>
			 <br/>
			<table class="table table-striped">
				<tr>
					<th>Mã đăng ký</th>
					<th>Tên sinh viên</th>
					<th>Tình trạng</th>
					<th>Ngày đăng ký sách</th>
					<th>Ngày nhận sách</th>						
				</tr>
				@foreach ($array_dang_ky_sach as $dang_ky_sach)
				<tr>
					<td>{{$dang_ky_sach->ma_dang_ky}}</td>
					<td>{{$dang_ky_sach->ten_sinh_vien}}</td>
					<td>{{$dang_ky_sach->ten_sach}}</td>
					<td>{{$dang_ky_sach->tinh_trang_nhan_sach}}</td>
					<td>{{$dang_ky_sach->ngay_dang_ky}}</td>
					<td>{{$dang_ky_sach->ngay_nhan_sach}}</td>
				</tr>
				@endforeach
			</table>		
		</div>
		<div id="right_content" >
			<div><h2>Đăng ký sách</h2></div>
				<div>
					<form>
						{{csrf_field()}}
						<table width="90%">
							<tr style="height: 4rem">
								<div>
									<td>
										<div>Khóa học</div>
										<div>
											<select class="form-control" style="width: 25rem" id="select_khoa_hoc">
												<option>--Khóa học--</option>
											</select>
										</div>
									</td>
								</div>
								<div id="div_lop">
									<td>
										<div>Tên lớp</div>
										<div>
											<select>
												<option>--Lớp--</option>
											</select>
										</div>
									</td>
								</div>							
							</tr>
							<tr style="height: 7rem">
								<div id="div_mon_hoc">
									<td>
										<div>Tên môn</div>
										<div>
											<select>
												<option>--Môn học--</option>
											</select>
										</div>
									</td>
								</div>
								<div id="div_sinh_vien">
									<td>
										<div>Tên sinh viên</div>
										<div>
											<select>
												<option>--tên sinh viên--</option>
											</select>
										</div>
									</td>
								</div>										
							</tr>
							<tr>
								<div id="div_sach">
									<td>
										<div>Tên sách</div>	
										<div>
											<select name="ma_sach">
												<option>--tên sách--</option>
											</select>
										</div>
									</td>
								</div>
								<div>
									<td>
										<div>Tình trạng</div>	
										<div>
											<select name="tinh_trang">
												<option>--Tình trạng--</option>
												<option>Đã nhận</option>
												<option>Chưa nhận</option>
											</select>
										</div>
									</td>
								</div>										
							</tr>
						</table><br><br>
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