@extends('layer.master')
@section('pageTitle', 'Quản lý lớp')
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<center></center>
	<div class="card">
		<h2 style="padding: 1%">Danh sách lớp</h2>
		<div class="content">
			<div class="toolbar">
	            <form>
				Tìm kiếm
					<input type="text" name="search" placeholder="lớp, khóa học" value="{{ Request::get('search') }}">
					<input type="submit" class="btn btn-info btn-round btn-sm btn-fill" value="Xem">	
					<input type="button" class="btn btn-round btn-sm btn-fill" value="Hủy tìm kiếm" onclick="location.href='{{ route('lop.view_all') }}'" style="margin-left: 5px">
					<input type="button" class="btn btn-success btn-fill btn-sm btn-round" value="Thêm mới" data-toggle="modal" data-target="#addModal" style="margin-left: 5px">
					<input type="button" class="btn btn-primary btn-round btn-sm btn-outline" value="Xuất file excel" onclick="location.href='{{ route('lop.export') }}'" style="margin-left: 5px">
					<input type="button" class="btn btn-danger btn-round btn-sm btn-outline" value="Xuất file pdf" onclick="location.href='{{ route('lop.export_pdf') }}'" style="margin-left: 5px">
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
				@if (Session::has('success'))
					<div class="alert alert-success alert-block">
						{{Session::get('success')}}
						<button type="button" aria-hidden="true" class="close" data-dismiss="alert">
	                        <i class="pe-7s-close"></i>
	                    </button>
			   		</div>
			    @endif
	        </div>
	        @if(count($array_lop) > 0)
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Mã</th>
						<th>Tên lớp</th>
						<th>Khóa học</th>
						<th>Chuyên ngành</th>
						<th>Sỹ số</th>
						<th colspan="2">Chức năng</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($array_lop as $lop)		
						<tr>
							<td>{{$lop->ma_lop}}</td>
							<td>{{$lop->ten_lop}}</td>
							<td>{{$lop->ten_khoa_hoc}}</td>
							<td>{{$lop->ten_chuyen_nganh}}</td>
							<td>{{$lop->sy_so}}</td>
							<td>
								<input type="button" class='button_update btn btn-warning btn-fill btn-sm' value="Cập nhật" data-toggle="modal" data-target="#updateModal" data-ma_lop='{{$lop->ma_lop}}'>
							</td>
							<td>
								<button class='button_update btn btn-info btn-fill btn-wd' onclick="location.href='{{route('sinh_vien.danh_sach_sinh_vien_by_lop', ['ma_lop' => $lop->ma_lop])}}'">Danh sách SV</button>
							</td>
						</tr>
					@endforeach
				</tbody>				
				<tfoot>
					<tr>
						<td colspan="100%">
							 {!! $array_lop->render()!!}
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
		          	<h4 class="modal-title">Thêm lớp</h4>
		        </div>
		        <div class="modal-body">
			        <form action="{{ route('lop.process_insert')}}" method="post" id="form_insert">
			        	{{csrf_field()}}
			          	<div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight:lighter">Tên lớp</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" name="ten_lop" id="lop" placeholder="bkc + (01,...) + k(1,...)" class="form-control">
									<span id="errLop" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight: lighter">Khóa học</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <select name="ma_khoa_hoc" id="khoa_hoc" class="form-control">
										<option value="-1" disabled="disabled" selected="selected">Tên khóa học</option>
										@foreach ($array_khoa_hoc as $khoa_hoc)
											<option value="{{$khoa_hoc->ma_khoa_hoc}}">
												{{$khoa_hoc->ten_khoa_hoc}}
											</option>			
										@endforeach
									</select>
									<span id="errKhoaHoc" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight: lighter">Chuyên ngành</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <select name="ma_chuyen_nganh" id="chuyen_nganh" class="form-control">
										<option value="-1" disabled="disabled" selected="selected">Tên chuyên ngành</option>
										@foreach ($array_chuyen_nganh as $chuyen_nganh)
											<option value="{{$chuyen_nganh->ma_chuyen_nganh}}">
												{{$chuyen_nganh->ten_chuyen_nganh}}
											</option>			
										@endforeach
									</select>
									<span id="errChuyenNganh" style="color: red"></span>
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

	<div class="modal fade" id="updateModal" role="dialog">
    	<div class="modal-dialog">
    
      <!-- Modal content-->
	      	<div class="modal-content">
		        <div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		          	<h4 class="modal-title">Cập nhật lớp</h4>
		        </div>
		        <div class="modal-body">
			        <form action="{{route('lop.process_update', ['ma_lop' => $lop->ma_lop])}}" method="post" id="form_update">
			        	{{csrf_field()}}
			          	<input type="hidden" name="ma_lop" id="ma_lop">
			          	<div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight:lighter">Tên lớp</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" name="ten_lop" id="ten" class="form-control">
									<span id="errTen" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight:lighter">Khóa học</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <select name="ma_khoa_hoc" id="ma_khoa_hoc" class="form-control">
						          		@foreach($array_khoa_hoc as $khoa_hoc)
											<option value="{{$khoa_hoc->ma_khoa_hoc}}">
												{{$khoa_hoc->ten_khoa_hoc}}
											</option>
										@endforeach
						          	</select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight: lighter">Chuyên ngành</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <select name="ma_chuyen_nganh" id="ma_chuyen_nganh" class="form-control">
										<option value="" disabled="disabled" selected="selected">Tên chuyên ngành</option>
										@foreach ($array_chuyen_nganh as $chuyen_nganh)
											<option value="{{$chuyen_nganh->ma_chuyen_nganh}}">
												{{$chuyen_nganh->ten_chuyen_nganh}}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script type="text/javascript">
	$("#search_khoa_hoc").select2();
	$("#select_khoa_hoc").select2();
	$(document).ready(function() {
		$(".button_update").click(function(event) {
			var ma_lop = $(this).data('ma_lop');
			$.ajax({
				url: '{{ route('lop.get_one') }}',
				dataType: 'json',
				data: {
					ma_lop: ma_lop
				},
			})
			.done(function(response) {
				$("#ma_lop").val(response.ma_lop);
				$("#ten").val(response.ten_lop);
				$("#ma_khoa_hoc").val(response.ma_khoa_hoc);
				$("#ma_chuyen_nganh").val(response.ma_chuyen_nganh);
			})
			
		});
	});
	function validate() {
		var dem = 0;
		var lop = document.getElementById('lop').value;
		var khoa_hoc = document.getElementById('khoa_hoc').value;
		var chuyen_nganh = document.getElementById('chuyen_nganh').value;
		var errLop = document.getElementById('errLop');
		var errKhoaHoc = document.getElementById('errKhoaHoc');
		var errChuyenNganh = document.getElementById('errChuyenNganh');

		if(lop.length == 0){
			errLop.innerHTML="Không được trống!";
		}else {
			errLop.innerHTML="";
			dem++;
		}
		if(khoa_hoc == -1){
			errKhoaHoc.innerHTML="Chưa chọn khóa học!";
		}else {
			errKhoaHoc.innerHTML="";
			dem++;
		}
		if(chuyen_nganh == -1){
			errChuyenNganh.innerHTML="Chưa chọn chuyên ngành!";
		}else {
			errChuyenNganh.innerHTML="";
			dem++;
		}
		if(dem == 3){
			document.getElementById('form_insert').submit();
		}
	}

	function validate_update() {
		var ten = document.getElementById('ten').value;
		var errTen = document.getElementById('errTen');

		if(ten.length == 0){
			errTen.innerHTML="Không được trống!";
		}else {
			document.getElementById('form_update').submit();
		}
	}
</script>
@endpush