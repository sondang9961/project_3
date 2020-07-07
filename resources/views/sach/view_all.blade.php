@extends('layer.master')
@section('pageTitle', 'Quản lý sách')
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
	<div class="card">
		<h2 style="padding: 1%">Danh sách các đầu sách</h2>
		<div class="content">
			<div class="toolbar">
				<form>
					Tìm kiếm
					<input type="text" name="search" placeholder="tên môn, sách" value="{{ Request::get('search') }}">
					<input type="submit" class="btn btn-round btn-sm btn-fill" value="Xem">
					<input type="button" class="btn btn-success btn-fill btn-sm btn-round" value="Thêm mới" data-toggle="modal" data-target="#addModal" style="margin-left: 4px">
					<input type="button" class="btn btn-info btn-round btn-sm btn-fill" value="Hiện tất cả" onclick="location.href='{{ route('sach.view_all') }}'" style="margin-left: 5px">
					<input type="button" class="btn btn-primary btn-round btn-sm btn-fill" value="Số lượng sách cần nhập" onclick="location.href='{{ route('sach.view_all') }}'" style="margin-left: 5px">
				</form>
			</div>
			<div>
	        	@if (Session::has('error'))
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
	        @if(count($array_sach) > 0)
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Tên sách</th>
						<th>Môn</th>
						<th>Số lượng nhập</th>
						<th>Ngày nhập</th>
						<th>Ngày hết hạn đăng ký</th>
						<th>Chức năng</th>
					</tr>
				</thead>		
				<tbody>
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
								<input type="button" class='button_update btn btn-warning btn-fill btn-sm' value="Cập nhật" data-toggle="modal" data-target="#updateModal" data-ma_sach='{{$sach->ma_sach}}'>
							</td>
						</tr>
					@endforeach
				</tbody>				
				<tfoot>
					<tr>
						<td colspan="100%">
							{!! $array_sach->render() !!}
						</td>
					</tr>
				</tfoot>
			</table>
			@else
				<h4><center>{{ $message}}</center></h4>	
			@endif
		</div>
	</div>

	<div class="modal fade" id="addModal" role="dialog">
    	<div class="modal-dialog">
    
      <!-- Modal content-->
	      	<div class="modal-content">
		        <div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		          	<h4 class="modal-title">Thêm sách</h4>
		        </div>
				<div class="modal-body">
			        <form action="{{route('sach.process_insert')}}" method="post" id="form">
			        	{{csrf_field()}}
                        <div class="row">
                            <label class="col-sm-3" style="	font-size: 1.75rem; font-weight:lighter">Tên môn</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <select name="ma_mon_hoc" style="width: 37rem" id="select_mon_hoc" >
										<option disabled selected>--Chọn môn học--</option>
										@foreach ($array_mon_hoc as $mon_hoc)
											<option value="{{$mon_hoc->ma_mon_hoc}}">
												{{$mon_hoc->ten_mon_hoc}}
											</option>
										@endforeach
									</select>
									<span id="errKhoaHoc" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight:lighter">Tên sách</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" name="ten_sach" id="ten_sach" class="form-control" disabled>
									<span id="errSach" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.7rem; font-weight:lighter">Số lượng</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="number" name="so_luong_nhap" id="so_luong_nhap" class="form-control" disabled>
									<span id="errSoLuongNhap" style="color: red"></span>
                                </div>
                            </div>
                        </div>
			        </form>
		        </div>
		        <div class="modal-footer">
		        	<input type="button" class="btn btn-fill btn-info btn-sm btn-round add_button" value="Thêm" id="button" onclick="validate()" disabled>
		          	<button type="button" class="btn btn-fill btn-default btn-sm btn-round" data-dismiss="modal">Close</button>
		        </div>
		    </div>
    	</div>
  	</div>
	

	<div class="modal fade" id="updateModal" role="dialog">
    	<div class="modal-dialog">
    
      <!-- Modal content-->
	      	<div class="modal-content">
		        <div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		          	<h4 class="modal-title">Cập nhật sách</h4>
		        </div>
		        <div class="modal-body">
			        <form action="{{route('sach.process_update')}}" method="post" id="form_update">
			        	{{csrf_field()}}
			          	<input type="hidden" name="ma_sach" id="ma_sach">
			          	<div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.7rem; font-weight:lighter">Môn học</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <select name="ma_mon_hoc" id="mon_hoc" class="form-control">
						          		@foreach($array_mon_hoc as $mon_hoc)
											<option value="{{$mon_hoc->ma_mon_hoc}}">
												{{$mon_hoc->ten_mon_hoc}}
											</option>
										@endforeach
						          	</select>
                                </div>
                            </div>
                        </div>
			          	<div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.7rem; font-weight:lighter">Tên sách</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" name="ten_sach" id="ten" class="form-control">
                                    <span id="errTen" style="color: red"></span>
                                </div>
                            </div>
                        </div>			          	
			          	<div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.7rem; font-weight:lighter">Số lượng</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="number" name="so_luong_nhap" id="so_luong" class="form-control">
									<span id="errSoLuong" style="color: red"></span>
                                </div>
                            </div>
                        </div>
			        </form>
		        </div>
		        <div class="modal-footer">
		        	<input type="button" class="btn btn-fill btn-info btn-sm btn-round" value="Cập nhật" onclick="validate_update()">
		          	<button type="button" class="btn btn-fill btn-default btn-sm btn-round" data-dismiss="modal">Close</button>
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
		$("#select_mon_hoc").select2();
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
