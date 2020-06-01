@extends('layer.master')
@section('pageTitle', 'Quản lý sinh viên')
@push('css')
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
	<div class="card">
		<h2 style="padding: 1%">Quản lý sinh viên</h2>
		<div class="content">
			<div class="toolbar">
				<form>
					Tìm kiếm
					<input type="text" name="search" placeholder="sinh viên, lớp học" value="{{ Request::get('search') }}">
					<input type="submit" class="btn btn-round btn-sm btn-fill" value="Xem">
					<input type="button" class="btn btn-success btn-fill btn-sm btn-round" value="Thêm mới" data-toggle="modal" data-target="#addModal" style="margin-left: 5px">
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
	        @if(count($array_sinh_vien) > 0)
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Mã</th>
						<th>Tên sinh viên</th>
						<th>Tên lớp</th>
						<th colspan="2">Chức năng</th>
					</tr>
				</thead>	
				<tbody>
					@foreach ($array_sinh_vien as $sinh_vien)
						<tr>
							<td>{{$sinh_vien->ma_sinh_vien}}</td>
							<td>{{$sinh_vien->ten_sinh_vien}}</td>
							<td>{{$sinh_vien->ten_lop}}</td>
							<td>
								<input type="button" class='button_update btn btn-warning btn-fill btn-sm' value="Cập nhật" data-toggle="modal" data-target="#myModal" data-ma_sinh_vien='{{$sinh_vien->ma_sinh_vien}}'>		
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
				{{ $message }}	
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
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight: lighter">Lớp</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <select name="ma_lop" id="select_lop" class="form-control">
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
			        <form action="{{route('sinh_vien.process_update', ['ma_sinh_vien' => $sinh_vien->ma_sinh_vien])}}" method="post" id="form_update">
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
                            <label class="col-sm-3" style="margin-top: 1%;font-size: 1.75rem; font-weight:lighter">Lớp</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <select name="ma_lop" id="ma_lop" class="form-control">
						          		@foreach($array_lop as $lop)
											<option value="{{$lop->ma_lop}}">
												{{$lop->ten_lop}}
											</option>
										@endforeach
						          	</select>
                                </div>
                            </div>
                        </div>						
			        	<div style="margin-top: 2rem">
			          		
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
				$("#ten_lop").val(response.ten_lop);
				$("#ma_lop").val(response.ma_lop);
			})
			
		});
	});
	function validate() {
		var dem = 0;
		var sinh_vien = document.getElementById('sinh_vien').value;
		var ma_lop = document.getElementById('select_lop').value;
		var errSinhVien = document.getElementById('errSinhVien');
		var errLop = document.getElementById('errLop');

		if(sinh_vien.length == 0){
			errSinhVien.innerHTML="Không được trống!";
		}else {
			errSinhVien.innerHTML="";
			dem++;
		}
		if(ma_lop == -1){
			errLop.innerHTML="Chưa chọn lớp!";
		}else {
			errLop.innerHTML="";
			dem++;
		}
		if(dem == 2){
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