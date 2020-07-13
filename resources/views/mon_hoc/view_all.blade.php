@extends('layer.master')
@section('pageTitle', 'Quản lý môn học')
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
	<div class="card">
		<h2 style="padding: 1%">Danh sách môn học</h2>
		<div class="content">
			<div class="toolbar">
				<form>
					Tìm kiếm
					<input type="text" name="search" placeholder="môn, chuyên ngành" value="{{ Request::get('search') }}">
					<input type="submit" class="btn btn-info btn-round btn-sm btn-fill" value="Xem">					
					<input type="button" class="btn btn-round btn-sm btn-fill" value="Hủy tìm kiếm" onclick="location.href='{{ route('mon_hoc.view_all') }}'" style="margin-left: 5px">
					<input type="button" class="btn btn-success btn-fill btn-sm btn-round" value="Thêm mới" data-toggle="modal" data-target="#addModal" style="margin-left: 5px">
					<input type="button" class="btn btn-primary btn-round btn-sm btn-outline" value="Xuất file excel" onclick="location.href='{{ route('mon_hoc.export') }}'" style="margin-left: 5px">
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
	        @if(count($array_mon_hoc) > 0)
			<table class="table table-striped table-no-bordered table-hover dataTable dtr-inline">
				<thead>
					<tr>
						<th>Mã</th>
						<th>Tên môn</th>
						<th>Chuyên ngành</th>
						<th colspan="2">Chức năng</th>
					</tr>
				</thead>	
				<tbody>
					@foreach ($array_mon_hoc as $mon_hoc)
						<tr>
							<td>{{$mon_hoc->ma_mon_hoc}}</td>
							<td>{{$mon_hoc->ten_mon_hoc}}</td>
							<td>{{$mon_hoc->ten_chuyen_nganh}}</td>
							<td>
								<input type="button" class='button_update btn btn-warning btn-fill btn-sm' value="Cập nhật" data-toggle="modal" data-target="#updateModal" data-ma_mon_hoc='{{$mon_hoc->ma_mon_hoc}}'>
							</td>
						</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td colspan="100%">
							 {!! $array_mon_hoc->render()!!}
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
		          	<h4 class="modal-title">Thêm môn học</h4>
		        </div>
		        <div class="modal-body">
			        <form action="{{route('mon_hoc.process_insert')}}" method="post" id="form_insert">
			        	{{csrf_field()}}
			          	<div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight:lighter">Tên môn học</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" name="ten_mon_hoc" id="mon_hoc" class="form-control">
									<span id="errMonHoc" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight: lighter">Chuyên ngành</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <select name="ma_chuyen_nganh" id="chuyen_nganh" class="form-control">
										<option value="" disabled="disabled" selected="selected">Tên khóa học</option>
										@foreach ($array_chuyen_nganh as $chuyen_nganh)
											<option value="{{$chuyen_nganh->ma_chuyen_nganh}}">
												{{$chuyen_nganh->ten_chuyen_nganh}}
											</option>			
										@endforeach
									</select>
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

	<div class="modal fade" id="updateModal" role="dialog">
    	<div class="modal-dialog">
    
      <!-- Modal content-->
	      	<div class="modal-content">
		        <div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		          	<h4 class="modal-title">Cập nhật môn học</h4>
		        </div>
		        <div class="modal-body">
			        <form action="{{route('mon_hoc.process_update')}}" method="post" id="form_update">
			        	{{csrf_field()}}
			          	<input type="hidden" name="ma_mon_hoc" id="ma_mon_hoc">
			          	<div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight:lighter">Tên môn học</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" name="ten_mon_hoc" id="ten" class="form-control">
									<span id="errTen" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight: lighter">Chuyên ngành</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <select name="ma_chuyen_nganh" id="ma_chuyen_nganh" class="form-control">
						          		@foreach($array_chuyen_nganh as $chuyen_nganh)
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
		        	<input type="button" value="Cập nhật" onclick="validate_update()" class="btn btn-fill btn-info btn-sm btn-round">
		          	<button type="button" class="btn btn-fill btn-default btn-sm btn-round" data-dismiss="modal">Close</button>
		        </div>
	      	</div>
    	</div>
  	</div>
@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script type="text/javascript">
	$("#search_chuyen_nganh").select2();
	$("#select_chuyen_nganh").select2();
	$(document).ready(function() {
		$(".button_update").click(function(event) {
			var ma_mon_hoc = $(this).data('ma_mon_hoc');
			$.ajax({
				url: '{{ route('mon_hoc.get_one') }}',
				dataType: 'json',
				data: {
					ma_mon_hoc: ma_mon_hoc
				},
			})
			.done(function(response) {
				$("#ma_mon_hoc").val(response.ma_mon_hoc);
				$("#ten").val(response.ten_mon_hoc);
				$("#ma_chuyen_nganh").val(response.ma_chuyen_nganh);
			})
			.fail(function() {
				console.log("error");
			});
			
		});
	});
	function validate() {
		var dem = 0;
		var mon_hoc = document.getElementById('mon_hoc').value;
		var chuyen_nganh = document.getElementById('chuyen_nganh').value;
		var errMonHoc= document.getElementById('errMonHoc');
		var errKhoaHoc = document.getElementById('errKhoaHoc');

		if(mon_hoc.length == 0){
			errMonHoc.innerHTML="Không được trống!";
		}else {
			errMonHoc.innerHTML="";
			dem++;
		}
		if(chuyen_nganh == ''){
			errKhoaHoc.innerHTML="Chưa chọn khóa học!";
		}else {
			errKhoaHoc.innerHTML="";
			dem++;
		}
		if(dem == 2){
			document.getElementById('form_insert').submit();
		}
	}

	function validate_update() {
		var ten = document.getElementById('ten').value;
		var errTen= document.getElementById('errTen');

		if(ten.length == 0){
			errTen.innerHTML="Không được trống!";
		}else {
			document.getElementById('form_update').submit();
		}
	}
</script>
@endpush