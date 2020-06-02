@extends('layer.master')
@section('pageTitle', 'Quản lý khóa học')
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<font face="Roboto,Helvetica Neue,Arial,sans-serif">
	<div class="card">
		<h2 style="padding: 1%">Danh sách khóa học</h2>
		<div class="content">
			<div class="toolbar">
	            <form>
					Khóa học
					<input type="text" name="ten_khoa_hoc" value="{{ Request::get('ten_khoa_hoc') }}">
					<input type="submit" class="btn btn-round btn-sm btn-fill" value="Xem">
					<input type="button" class="btn btn-success btn-fill btn-sm btn-round" value="Thêm mới" data-toggle="modal" data-target="#addModal" style="margin-left: 5px">
					<input type="button" class="btn btn-info btn-round btn-sm btn-fill" value="Hiện tất cả" onclick="location.href='{{ route('khoa_hoc.view_all') }}'" style="margin-left: 5px">
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
			    @if (Session::has('upd_error'))
					<span style="color: red">
			            {{Session::get('upd_error')}}
			        </span>
				@endif
				@if (Session::has('upd_success'))
			        <span style="color: green">
			            {{Session::get('upd_success')}}
			        </span>
			    @endif
	        </div>
	        @if(isset($array_khoa_hoc))
			<table class="table table-striped table-no-bordered table-hover dataTable dtr-inline">
				<thead>
					<tr>
						<th>Mã</th>
						<th>Tên khóa học</th>
						<th>Chức năng</th>
					</tr>
				</thead>	
				<tbody>
					@foreach ($array_khoa_hoc as $khoa_hoc)
						<tr>
							<td>{{$khoa_hoc->ma_khoa_hoc}}</td>
							<td>
								{{$khoa_hoc->ten_khoa_hoc}}
							</td>
							<td>
								<input type="button" class='button_update btn btn-warning btn-fill btn-sm' value="Cập nhật" data-toggle="modal" data-target="#updateModal" data-ma_khoa_hoc='{{$khoa_hoc->ma_khoa_hoc}}'>
							</td>
						</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td colspan="100%">
							 {!! $array_khoa_hoc->render()!!}
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
			        <form action="{{route('khoa_hoc.process_insert')}}" method="post" id="form_insert">
			        	{{csrf_field()}}
		                <div class="row">
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight:lighter">Tên khóa học</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="ten_khoa_hoc" id="khoa_hoc">
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
	      	<div class="modal-content">
		        <div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		          	<h4 class="modal-title">Cập nhật khóa học</h4>
		        </div>
		        <div class="modal-body">
			        <form action="{{route('khoa_hoc.process_update')}}" method="post" id="form_update">
			        	{{csrf_field()}}
			          	<input type="hidden" name="ma_khoa_hoc" id="ma_khoa_hoc">
			        	<div class="row">
                            <label class="col-sm-3 col-form-label" style="margin-top: 1%;font-size: 1.75rem; font-weight: normal">Tên khóa học</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="ten_khoa_hoc" id="ten">
									<span id="errTen" style="color: red"></span>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
  	<script type="text/javascript">
  		$("#search_khoa_hoc").select2();
  		$(document).ready(function() {
  			$(".button_update").click(function(event) {
  				var ma_khoa_hoc = $(this).data('ma_khoa_hoc');
  				$.ajax({
  					url: '{{ route('khoa_hoc.get_one') }}',
  					dataType: 'json',
  					data: {
  						ma_khoa_hoc: ma_khoa_hoc
  					},
  				})
  				.done(function(response) {
  					$("#ma_khoa_hoc").val(response.ma_khoa_hoc);
  					$("#ten").val(response.ten_khoa_hoc);
  				})
  				.fail(function() {
  					console.log("error");
  				});		
  			});
  		});

  		function validate() {
  			var dem = 0;
  			var khoa_hoc = document.getElementById('khoa_hoc').value;
  			var errKhoaHoc = document.getElementById('errKhoaHoc');

  			if(khoa_hoc.length == 0){
  				errKhoaHoc.innerHTML="Không được trống!";
  			}else{
  				errKhoaHoc.innerHTML="";
  				dem++;
  			}
  			if(dem == 1){
  				document.getElementById('form_insert').submit();
  			}
  		}

  		function validate_update() {
  			var ten = document.getElementById('ten').value;
  			var errTen = document.getElementById('errTen');

  			if(ten.length == 0){
  				errTen.innerHTML="Không được trống!";
  			}else{
  				document.getElementById('form_update').submit();
  			}
  		}
  	</script>
@endpush
  	
