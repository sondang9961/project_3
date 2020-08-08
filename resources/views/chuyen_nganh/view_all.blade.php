@extends('layer.master')
@section('pageTitle', 'Quản lý chuyên ngành')
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<font face="Roboto,Helvetica Neue,Arial,sans-serif">
	<div class="card">
		<h2 style="padding: 1%">Danh sách chuyên ngành</h2>
		<div class="content">
			<div class="toolbar">
	            <form>
					Tìm kiếm
					<input type="text" name="ten_chuyen_nganh" placeholder="tên chuyên ngành" value="{{ Request::get('ten_chuyen_nganh') }}">
					<input type="submit" class="btn btn-info btn-round btn-sm btn-fill" value="Xem">
					<input type="button" class="btn btn-round btn-sm btn-fill" value="Hủy tìm kiếm" onclick="location.href='{{ route('chuyen_nganh.view_all') }}'" style="margin-left: 5px">
					<input type="button" class="btn btn-success btn-fill btn-sm btn-round" value="Thêm mới" data-toggle="modal" data-target="#addModal" style="margin-left: 5px">
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
	        @if(isset($array_chuyen_nganh))
			<table class="table table-striped table-no-bordered table-hover dataTable dtr-inline">
				<thead>
					<tr>
						<th>Mã</th>
						<th>Tên chuyên ngành</th>
						<th>Chức năng</th>
					</tr>
				</thead>	
				<tbody>
					@foreach ($array_chuyen_nganh as $chuyen_nganh)
						<tr>
							<td>{{$chuyen_nganh->ma_chuyen_nganh}}</td>
							<td>
								{{$chuyen_nganh->ten_chuyen_nganh}}
							</td>
							<td>
								<input type="button" class='button_update btn btn-warning btn-fill btn-sm' value="Cập nhật" data-toggle="modal" data-target="#updateModal" data-ma_chuyen_nganh='{{$chuyen_nganh->ma_chuyen_nganh}}'>
							</td>
						</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td colspan="100%">
							 {!! $array_chuyen_nganh->render()!!}
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
	      	<div class="modal-content">
		        <div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		          	<h4 class="modal-title">Thêm khóa học</h4>
		        </div>
		        <div class="modal-body">
			        <form action="{{route('chuyen_nganh.process_insert')}}" method="post" id="form_insert">
			        	{{csrf_field()}}
		                <div class="row">
                            <label class="col-sm-4" style="margin-top: 1%;font-size: 1.75rem; font-weight:lighter">Tên chuyên ngành</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="ten_chuyen_nganh" id="chuyen_nganh">
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
	      	<div class="modal-content">
		        <div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		          	<h4 class="modal-title">Cập nhật chuyên ngành</h4>
		        </div>
		        <div class="modal-body">
			        <form action="{{route('chuyen_nganh.process_update')}}" method="post" id="form_update">
			        	{{csrf_field()}}
			          	<input type="hidden" name="ma_chuyen_nganh" id="ma_chuyen_nganh">
			        	<div class="row">
                            <label class="col-sm-4" style="margin-top: 1%;font-size: 1.75rem; font-weight:lighter">Tên chuyên ngành</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="ten_chuyen_nganh" id="ten">
									<span id="errTenChuyenNganh" style="color: red"></span>
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
</font>
@endsection
@push('js')
<script type="text/javascript">
	$(document).ready(function() {
		$(".button_update").click(function(event) {
			var ma_chuyen_nganh = $(this).data('ma_chuyen_nganh');
			$.ajax({
				url: '{{ route('chuyen_nganh.get_one') }}',
				dataType: 'json',
				data: {
					ma_chuyen_nganh: ma_chuyen_nganh
				},
			})
			.done(function(response) {
				$("#ma_chuyen_nganh").val(response.ma_chuyen_nganh);
				$("#ten").val(response.ten_chuyen_nganh);
			})
			.fail(function() {
				console.log("error");
			});		
		});
	});

	function validate() {
		var dem = 0;
		var chuyen_nganh = document.getElementById('chuyen_nganh').value;
		var errChuyenNganh = document.getElementById('errChuyenNganh');

		if(chuyen_nganh.length == 0){
			errChuyenNganh.innerHTML="Không được trống!";
		}else{
			errChuyenNganh.innerHTML="";
			dem++;
		}
		if(dem == 1){
			document.getElementById('form_insert').submit();
		}
	}

	function validate_update() {
		var ten = document.getElementById('ten').value;
		var errTenChuyenNganh = document.getElementById('errTenChuyenNganh');

		if(ten.length == 0){
			errTenChuyenNganh.innerHTML="Không được trống!";
		}else{
			document.getElementById('form_update').submit();
		}
	}
</script>
@endpush
  	
