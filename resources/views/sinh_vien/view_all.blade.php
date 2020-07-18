@extends('layer.master')
@section('pageTitle', 'Quản lý sinh viên')
@push('css')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
	<div class="card">
		<h2 style="padding: 1%">Quản lý sinh viên</h2>
		<div class="content">
			@if($message = Session::get('import_success'))
		   		<div class="alert alert-success alert-block">
		    		<button type="button" aria-hidden="true" class="close" data-dismiss="alert">
                        <i class="pe-7s-close"></i>
                    </button>
		           <strong>{{ $message }}</strong>
		   		</div>
			@endif
			@if($message = Session::get('import_fail'))
		   		<div class="alert alert-danger alert-block">
		    		<button type="button" aria-hidden="true" class="close" data-dismiss="alert">
                        <i class="pe-7s-close"></i>
                    </button>
		           <strong>{{ $message }}</strong>
		   		</div>
			@endif
			<form method="post" enctype="multipart/form-data" action="{{ route('sinh_vien.import') }}">
		    {{ csrf_field() }}
			    <div class="form-group">
			    	<h5 align="center">Nhập sinh viên từ file excel</h5>
			     	<table class="table">
			      		<tr>
				       		<td width="40%" align="right">
				       			<label>Chọn file excel (.xls, .xlsx)</label>
				       		</td>
				       		<td width="30">
				        		<input type="file" name="select_file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
				       		</td>
				       		<td width="30%" align="left">
				        		<input type="submit" name="upload" class="btn btn-primary btn-sm btn-fill" value="Tải lên">
				       		</td>
				      	</tr>
				      	<tr>
				       		<td width="20%" align="right"></td>
				       		<td width="50" align="left"></td>
				       		<td width="30%" align="left"></td>
				      	</tr>
				    </table>
				</div>
		   	</form>
			<div class="toolbar">
				<form>
					<table>
						<tr>
							<td>
								Tìm kiếm <br>
								<input type="text" name="search" placeholder="tên sinh viên, lớp học" value="{{ Request::get('search') }}">
							</td>
							<td style="padding-left: 10px; padding-top: 15px">
								<input type="submit" class="btn btn-info btn-round btn-sm btn-fill" value="Xem">
								<input type="button" class="btn btn-round btn-sm btn-fill" value="Hủy tìm kiếm" onclick="location.href='{{ route('sinh_vien.view_all') }}'" style="margin-left: 5px">
								<input type="button" class="btn btn-success btn-fill btn-sm btn-round" value="Thêm mới" data-toggle="modal" data-target="#addModal" style="margin-left: 5px">
								@if(count($array_sinh_vien) > 0)
									<input type="button" class="btn btn-primary btn-round btn-sm btn-outline" value="Xuất file excel" onclick="location.href='{{ route('sinh_vien.export',['search' => $search]) }}'" style="margin-left: 5px">
									<input type="button" class="btn btn-danger btn-round btn-sm btn-outline" value="Xuất file pdf" onclick="location.href='{{ route('sinh_vien.export_pdf',['search' => $search]) }}'" style="margin-left: 5px">
								@endif
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div style="margin-top: 12px">
	        	@if (Session::has('error'))
	        		<div class="alert alert-danger alert-block">
						{{Session::get('error')}}
						<button type="button" aria-hidden="true" class="close" data-dismiss="alert">
	                        <i class="pe-7s-close"></i>
	                    </button>
			   		</div>
				@endif
				@if (Session::has('delete'))
	        		<div class="alert alert-warning alert-block">
						{{Session::get('delete')}}
						<button type="button" aria-hidden="true" class="close" data-dismiss="alert">
	                        <i class="pe-7s-close"></i>
	                    </button>
			   		</div>
				@endif
				@if (Session::has('success'))
					<div class="alert alert-success alert-block">
						{{Session::get('success')}}
						<button type="button" aria-hidden="true" class="close" data-dismiss="alert">
	                        <i class="pe-7s-close"></i>
	                    </button>
			   		</div>
			    @endif
	        </div>
    		<br />
		   	
	        @if(count($array_sinh_vien) > 0)
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
						<th colspan="2">Chức năng</th>
					</tr>
				</thead>	
				<tbody>
					@foreach ($array_sinh_vien as $sinh_vien)
						<tr>
							<td>{{$sinh_vien->ma_sinh_vien}}</td>
							<td>{{$sinh_vien->ten_sinh_vien}}</td>
							<td>{{date_format(date_create($sinh_vien->ngay_sinh),'d/m/Y')}}</td>
							<td>{{$sinh_vien->email}}</td>
							<td>{{$sinh_vien->sdt}}</td>
							<td>{{$sinh_vien->dia_chi}}</td>
							<td>{{$sinh_vien->ten_lop}}</td>
							<td>
								<input type="button" class='button_update btn btn-warning btn-fill btn-sm' value="Cập nhật" data-toggle="modal" data-target="#myModal" data-ma_sinh_vien='{{$sinh_vien->ma_sinh_vien}}'>		
							</td>
							<td>
								<input type="button" class='button_update btn btn-danger btn-fill btn-sm' value="Xóa" onclick="if(confirm('Bạn có chắc muốn xóa!'))location.href='{{ route('sinh_vien.delete_process',['ma_sinh_vien' => $sinh_vien->ma_sinh_vien]) }}'">		
							</td>				
						</tr>
					@endforeach
				</tbody>				
				<tfoot>
					<tr>
						<td colspan="100%">
							 {!! $array_sinh_vien->render()!!}
						</td>
					</tr>
				</tfoot>
			</table>
			@else
				<h4><center>Không tìm thấy kết quả</center></h4>	
			@endif	
		</div>
	</div>

	<div class="modal fade" id="addModal" role="dialog">
    	<div class="modal-dialog">
    
      <!-- Modal content-->
	      	<div class="modal-content">
		        <div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		          	<h4 class="modal-title">Thêm sinh viên</h4>
		        </div>
		        <div class="modal-body">
			        <form action="{{ route('sinh_vien.process_insert')}}" method="post" id="form_insert">
			        	{{csrf_field()}}
			          	<div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight:lighter">Tên sinh viên</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" name="ten_sinh_vien" id="sinh_vien" class="form-control">
									<span id="errSinhVien" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight:lighter">Ngày sinh</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="date" name="ngay_sinh" id="ngay_sinh" class="form-control">
									<span id="errNgaySinh" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight:lighter">Email</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control">
									<span id="errEmail" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight:lighter">Số điện thoại</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" name="sdt" id="sdt" class="form-control">
									<span id="errSdt" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight:lighter">Địa chỉ</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" name="dia_chi" id="dia_chi" class="form-control">
									<span id="errDiaChi" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3" style="font-size: 1.75rem; font-weight: lighter">Lớp</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <select name="ma_lop" id="select_lop" class="form-control" style="width: 37rem">
										<option value="-1">--Tên lớp--</option>
										@foreach($array_lop as $lop)
											<option value="{{$lop->ma_lop}}">
												{{$lop->ten_lop}}
											</option>
										@endforeach
									</select>
									<span id="errLop" style="color: red"></span>
									<span id="errKhoaHoc" style="color: red"></span>
                                </div>
                            </div>
                        </div>					        	
			        </form>
		        </div>
		        <div class="modal-footer">
		        	<input type="button" class="btn btn-fill btn-info btn-sm btn-round" value="Thêm" id="button" onclick="validate()">
		          	<button type="button" class="btn btn-fill btn-default btn-sm btn-round" data-dismiss="modal">Close</button>
		        </div>
	      	</div>
    	</div>
  	</div>

	<div class="modal fade" id="myModal" role="dialog">
    	<div class="modal-dialog">
    
      <!-- Modal content-->
	      	<div class="modal-content">
		        <div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		          	<h4 class="modal-title">Cập nhật sinh viên</h4>
		        </div>
		        <div class="modal-body">
			        <form action="{{route('sinh_vien.process_update')}}" method="post" id="form_update">
			        	{{csrf_field()}}
			          	<input type="hidden" name="ma_sinh_vien" id="ma_sinh_vien">
						<div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight:lighter">Tên sinh viên</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" name="ten_sinh_vien" id="ten" class="form-control">
									<span id="errTen" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight:lighter">Ngày sinh</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="date" name="ngay_sinh" id="ngay_sinh_upd" class="form-control">
									<span id="errNgaySinhUpd" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight:lighter">Email</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="email" name="email" id="email_upd" class="form-control">
									<span id="errEmailUpd" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight:lighter">Số điện thoại</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" name="sdt" id="sdt_upd" class="form-control">
									<span id="errSdtUpd" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight:lighter">Địa chỉ</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" name="dia_chi" id="dia_chi_upd" class="form-control">
									<span id="errDiaChiUpd" style="color: red"></span>
                                </div>
                            </div>
                        </div>	
			          	<div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight:lighter">Lớp</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <select name="ma_lop" id="ma_lop" class="form-control" style="width: 34.5rem">
						          		@foreach($array_lop as $lop)
											<option value="{{$lop->ma_lop}}">
												{{$lop->ten_lop}}
											</option>
										@endforeach
						          	</select>
                                </div>
                            </div>
                        </div>							
			        </form>
		        </div>
		        <div class="modal-footer">
		        	<input type="button" value="Sửa" onclick="validate_update()" class="btn btn-fill btn-info btn-sm btn-round">
		          	<button type="button" class="btn btn-fill btn-default btn-sm btn-round" data-dismiss="modal">Close</button>
		        </div>
	      	</div>
    	</div>
  	</div>
@endsection
@push('js')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
	$("#select_lop").select2();
	$("#ma_lop").select2();

	$(document).ready(function() {
		$(".button_update").click(function(event) {
			var ma_sinh_vien = $(this).data('ma_sinh_vien');
			$.ajax({
				url: '{{ route('sinh_vien.get_one') }}',
				dataType: 'json',
				data: {
					ma_sinh_vien: ma_sinh_vien
				},
			})
			.done(function(response) {
				$("#ma_sinh_vien").val(response.ma_sinh_vien);
				$("#ten").val(response.ten_sinh_vien);
				$("#ngay_sinh_upd").val(response.ngay_sinh);
				$("#email_upd").val(response.email);
				$("#sdt_upd").val(response.sdt);	
				$("#dia_chi_upd").val(response.dia_chi);	
				$("#ma_lop").val(response.ma_lop);
			})
			
		});
	});
	function validate() {
		var dem = 0;
		var sinh_vien = document.getElementById('sinh_vien').value;
		var ngay_sinh = document.getElementById('ngay_sinh').value;
		var sdt = document.getElementById('sdt').value;
		var email = document.getElementById('email').value;
		var dia_chi = document.getElementById('dia_chi').value;
		var ma_lop = document.getElementById('select_lop').value;
		var errSinhVien = document.getElementById('errSinhVien');
		var errNgaySinh = document.getElementById('errNgaySinh');
		var errSdt = document.getElementById('errSdt');
		var errEmail = document.getElementById('errEmail');
		var errDiaChi = document.getElementById('errDiaChi');
		var errLop = document.getElementById('errLop');

		if(sinh_vien.length == 0){
			errSinhVien.innerHTML="Không được trống!";
		}else {
			errSinhVien.innerHTML="";
			dem++;
		}

		if(ngay_sinh.length == 0){
			errNgaySinh.innerHTML="Không được trống!";
		}else {
			errNgaySinh.innerHTML="";
			dem++;
		}

		if(email.length == 0){
			errEmail.innerHTML="Không được trống!";
		}else {
			errEmail.innerHTML="";
			dem++;
		}

		if(sdt.length == 0){
			errSdt.innerHTML="Không được trống!";
		}else {
			errSdt.innerHTML="";
			dem++;
		}

		if(dia_chi.length == 0){
			errDiaChi.innerHTML="Không được trống!";
		}else {
			errDiaChi.innerHTML="";
			dem++;
		}

		if(ma_lop == -1){
			errLop.innerHTML="Chưa chọn lớp!";
		}else {
			errLop.innerHTML="";
			dem++;
		}
		if(dem == 6){
			document.getElementById('form_insert').submit();
		}
	}

	function validate_update() {
		var dem = 0;
		var ten = document.getElementById('ten').value;
		var ngay_sinh_upd = document.getElementById('ngay_sinh_upd').value;
		var email_upd = document.getElementById('email_upd').value;
		var sdt_upd = document.getElementById('sdt_upd').value;
		var dia_chi_upd = document.getElementById('dia_chi_upd').value;
		var errTen = document.getElementById('errTen');
		var errNgaySinhUpd = document.getElementById('errNgaySinhUpd');
		var errEmailUpd = document.getElementById('errEmailUpd');
		var errSdtUpd = document.getElementById('errSdtUpd');
		var errDiaChiUpd = document.getElementById('errDiaChiUpd');
		
		if(ten.length == 0){
			errTen.innerHTML="Không được trống!";
		}else {
			errTen.innerHTML="";
			dem++;
		}

		if(ngay_sinh_upd.length == 0){
			errNgaySinhUpd.innerHTML="Không được trống!";
		}else {
			errNgaySinhUpd.innerHTML="";
			dem++;
		}

		if(email_upd.length == 0){
			errEmailUpd.innerHTML="Không được trống!";
		}else {
			errEmailUpd.innerHTML="";
			dem++;
		}

		if(sdt_upd.length == 0){
			errSdtUpd.innerHTML="Không được trống!";
		}else {
			errSdtUpd.innerHTML="";
			dem++;
		}

		if(dia_chi_upd.length == 0){
			errDiaChiUpd.innerHTML="Không được trống!";
		}else {
			errDiaChiUpd.innerHTML="";
			dem++;
		}

		if(dem == 5){
			document.getElementById('form_update').submit();
		}
	}
</script>
@endpush