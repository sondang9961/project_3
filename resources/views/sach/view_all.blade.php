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
<center><h1 id="header">Quản lý sách</h1></center>
	<div id="main_content">
		<div id="left_content">
			<div><h2>Danh sách các đầu sách</h2></div>
			<form>
				<table style="width: 100%">
					<tr style="height: 4rem">
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
						<td>
							Tên sách
						</td>
						<td>
							<select name="ma_sach" class="form-control" style="width: 14rem" id="search_sach" disabled>
								<option>--Sách--</option>
							</select>
						</td>			
						<td><input type="submit" value="Xem" id="button" class="search_button" disabled></td>
					</tr>
					<tr>
						<td>
							<a href="{{ route('sach.view_all') }}">Hiển thị tất cả</a>
						</td>
					</tr>
			</form>
			<br>
			<table class="table table-striped">
				<thead>
					<tr>
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
					<td>{{$sach->ten_sach}}</td>
					<td>{{$sach->ten_mon_hoc}}</td>
					<td>{{$sach->so_luong_nhap}}</td>
					<td>
						{{date_format(date_create($sach->ngay_nhap_sach),'d/m/Y')}}
					</td>
					<td>{{date_format(date_create($sach->ngay_het_han),'d/m/Y')}}</td>
					<td>
						<input type="button" class='button_update' value="Cập nhật" data-toggle="modal" data-target="#myModal" data-ma_sach='{{$sach->ma_sach}}'>
					</td>
				</tr>
				@endforeach
				<tfoot>
					<tr>
						<td colspan="100%">
							Trang:
							@if ($trang > 1)
								<button type="button" onclick="location.href='{{ route('sach.view_all',[
										'trang' => 1, 
										'ma_mon_hoc' => $ma_mon_hoc,
										'ma_sach' => $ma_sach,
										]) }}'">				
									Đầu
								</button> 
								<a href="{{ route('sach.view_all',[
										'trang' => $prev, 
										'ma_mon_hoc' => $ma_mon_hoc,
										'ma_sach' => $ma_sach,
										]) }}" style="font-weight:bold; color: black " >
									<<
								</a>
							@endif
							@if ($count_trang > 7)
								@for ($i = $startpage; $i <= $endpage; $i++)
									<button type="button" onclick="location.href='{{ route('sach.view_all',[
											'trang' => $i, 
											'ma_mon_hoc' => $ma_mon_hoc,
											'ma_sach' => $ma_sach,
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
									<button type="button" onclick="location.href='{{ route('sach.view_all',[
										'trang' => $i, 
										'ma_mon_hoc' => $ma_mon_hoc,
										'ma_sach' => $ma_sach,
										]) }}'"
										@if ($trang==$i)
											style='background-color: grey; color: white'
										@endif
										>
										{{$i}}
									</button>
								@endfor
							@endif
							@if ($trang < $count_trang)
								<a href="{{ route('sach.view_all',[
										'trang' => $next, 
										'ma_mon_hoc' => $ma_mon_hoc,
										'ma_sach' => $ma_sach,
										]) }}" style="font-weight:bold; color: black " >
									>>
								</a>
								<button type="button" onclick="location.href='{{ route('sach.view_all',[
										'trang' => $count_trang, 
										'ma_mon_hoc' => $ma_mon_hoc,
										'ma_sach' => $ma_sach,
										]) }}'">
									Cuối
								</button>
							@endif 
							
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
		<div id="right_content" >
			<div><h2>Thêm sách</h2></div>
			<div>
				<form action="{{route('sach.process_insert')}}" method="post" id="form"> 
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
						<span id="errSach" style="color: red"></span>
					</div>
					<div class="form-group ">
						<div>Số lượng</div>	
						<div>
							<input type="number" name="so_luong_nhap" id="so_luong_nhap" class="form-control" style="width: 25rem" disabled>
						</div>
						<span id="errSoLuongNhap" style="color: red"></span>
					</div>	
					<div>
						@if(Session::has('error'))
							<span style="color: red">
                                {{Session::get('error')}}
                            </span>
						@endif
						@if (Session::has('success'))
                            <span style="color: green">
                                {{Session::get('success')}}
                            </span>
                        @endif
					</div>					
					<br>	
					<div><input type="button" value="Thêm" id="button" onclick="validate()" class="add_button" disabled></div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="myModal" role="dialog">
    	<div class="modal-dialog">
    
      <!-- Modal content-->
	      	<div class="modal-content">
		        <div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		          	<h4 class="modal-title">Cập nhật sách</h4>
		        </div>
		        <div class="modal-body">
			        <form action="{{route('sach.process_update', ['ma_sach' => $sach->ma_sach])}}" method="post" id="form_update">
			        	{{csrf_field()}}
			          	<input type="hidden" name="ma_sach" id="ma_sach">
			          	<div class="form-group">
			          		Tên sách<br>
			          		<input type="text" name="ten_sach" id="ten" class="form-control"><br>
			          		<span id="errTen" style="color: red"></span>
			          	</div>
			          	<div class="form-group">
			          		Môn học
				          	<select name="ma_mon_hoc" id="mon_hoc" class="form-control">
				          		@foreach($array_mon_hoc as $mon_hoc)
									<option value="{{$mon_hoc->ma_mon_hoc}}">
										{{$mon_hoc->ten_mon_hoc}}
									</option>
								@endforeach
				          	</select>
			          	</div>
						<div class="form-group">
							Số lượng<br>
				          	<input type="number" name="so_luong_nhap" id="so_luong" class="form-control">
						</div>
						<span id="errSoLuong" style="color: red"></span>
			          	{{-- <div class="form-group">
			          		Ngày nhập sách<br>
			          		<input type="date" name="ngay_nhap_sach" id="ngay_nhap_sach" class="form-control">
			          	</div>
			          	<div class="form-group">
			          		Ngày hết hạn<br>
			          		<input type="date" name="ngay_het_han" id="ngay_het_han" class="form-control">
			          	</div>--}}
			        	<div style="margin-top: 2rem ">
			          		<input type="button" value="Sửa" onclick="validate_update()" class="btn-sm">
			          	</div>	 
			        </form>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        </div>
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
			$("#so_luong_nhap").attr("disabled", true);
			$(".add_button").attr("disabled", true);
		});
		$("#select_mon_hoc").change(function(){
			$("#ten_sach").val(null).trigger('change');
			$("#ten_sach").attr("disabled", false);
			$("#so_luong_nhap").attr("disabled", true);
			$(".add_button").attr("disabled", true);
		})
		$("#ten_sach").change(function(){	
			$("#so_luong_nhap").val(null).trigger('change');
			if($("#so_luong_nhap"))
			$("#so_luong_nhap").attr("disabled", false);
			$(".add_button").attr("disabled", true);

		})
		$("#so_luong_nhap").change(function(){
			if($("#so_luong_nhap").val()==null)
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
								text: `${item.ten_sach} (${formatDate(item.ngay_nhap_sach)})`,
								id: item.ma_sach
							}
						})
					};
				}
			}
		});	

		//CẬP NHẬT
		$(".button_update").click(function(event) {
			var ma_sach = $(this).data('ma_sach');
			$.ajax({
				url: '{{ route('sach.get_one') }}',
				dataType: 'json',
				data: {
					ma_sach: ma_sach
				},
			})
			.done(function(response) {
				$("#ma_sach").val(response.ma_sach);
				$("#ten").val(response.ten_sach);
				$("#mon_hoc").val(response.ma_mon_hoc);
				$("#so_luong").val(response.so_luong_nhap);
				// $("#ngay_nhap_sach").val(response.ngay_nhap_sach);
				// $("#ngay_het_han").val(response.ngay_het_han);
			})
			.fail(function() {
				console.log("error");
			});
			
		});
	});
	
</script>
<script type="text/javascript">
	function validate() {
		var dem=0;
		var ten_sach = document.getElementById('ten_sach').value;
		var so_luong_nhap = document.getElementById('so_luong_nhap').value;
		var errSach = document.getElementById('errSach');
		var errSoLuongNhap = document.getElementById('errSoLuongNhap');

		if(ten_sach.length == 0){
			errSach.innerHTML="Chưa nhập tên sách";
		}else{
			errSach.innerHTML="";
			dem++;
		}

		if (so_luong_nhap.length == 0){
			errSoLuongNhap.innerHTML="Chưa nhập số lượng";
		}
		else if (so_luong_nhap < 0){
			errSoLuongNhap.innerHTML="Số lượng không được âm";
		}
		else{
			errSoLuongNhap.innerHTML="";
			dem++;
		}
		if(dem==2){
			document.getElementById("form").submit();
		}
	}

	function validate_update() {
		var dem = 0;
		var ten = document.getElementById('ten').value;
		var errTen = document.getElementById('errTen');
		var so_luong = document.getElementById('so_luong').value;
		var errSoLuong = document.getElementById('errSoLuong');

		if(ten.length == 0){
			errTen.innerHTML="Chưa nhập tên sách";
		}else{
			errTen.innerHTML="";
			dem++;
		}

		if (so_luong < 0){
			errSoLuong.innerHTML="Số lượng không được âm";
		}
		else if (so_luong.length == 0){
			errSoLuong.innerHTML="Chưa nhập số lượng";
		}
		else{
			errSoLuong.innerHTML="";
			dem++;
		}

		if(dem == 2){
			document.getElementById("form_update").submit();
		}
	}
</script>
@endpush
