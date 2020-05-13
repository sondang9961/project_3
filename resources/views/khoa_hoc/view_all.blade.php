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
					<select name="ma_khoa_hoc" style="width: 16.5rem" id="search_khoa_hoc">
						<option value="">Xem Tất Cả</option>
						@foreach($array_all_khoa_hoc as $khoa_hoc)
							<option value="{{$khoa_hoc->ma_khoa_hoc}}"
							@if ($khoa_hoc->ma_khoa_hoc == $ma_khoa_hoc)
								selected 
							@endif
							>
								{{$khoa_hoc->ten_khoa_hoc}}
							</option>
						@endforeach
					</select>
					<input type="submit" class="btn btn-round btn-sm btn-fill" value="Xem">
					<input type="button" class="btn btn-success btn-fill btn-sm btn-round" value="Thêm mới" data-toggle="modal" data-target="#addModal" style="margin-left: 5px">
				</form>
	        </div>
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
								<i class="btn btn-simple btn-warning btn-icon table-action edit fa fa-edit button_update" data-toggle="modal" data-target="#updateModal" data-ma_khoa_hoc='{{$khoa_hoc->ma_khoa_hoc}}'></i>
							</td>
						</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr style="background-color: none; border: none;">
						<td style="background-color: none; border: none;">
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
						</td>
					</tr>
					<tr>
						<td colspan="100%">
							Trang:
							@if ($trang > 1)
								<button type="button" onclick="location.href='{{ route('khoa_hoc.view_all',[
										'trang' => 1,
										'ma_khoa_hoc' => $ma_khoa_hoc
									]) }}'" 				
								>
									Đầu
								</button>
								<button type="button" onclick="location.href='{{ route('khoa_hoc.view_all',[
										'trang' => $prev, 
										'ma_khoa_hoc' => $ma_khoa_hoc
									]) }}'" style="font-weight:bold; color: black" >
									<
								</button>
							@endif
							@if ($count_trang > 7)
								@for ($i = $startpage; $i <= $endpage; $i++)
									<button type="button" onclick="location.href='{{ route('khoa_hoc.view_all',[
											'trang' => $i,
											'ma_khoa_hoc' => $ma_khoa_hoc
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
									<button type="button" onclick="location.href='{{ route('khoa_hoc.view_all',[
											'trang' => $i, 
											'ma_khoa_hoc' => $ma_khoa_hoc
										]) }}'"
										@if ($trang==$i)
											style="background-color: grey; color: white"
										@endif
										>
										{{$i}}
									</button>
								@endfor
							@endif
							@if ($trang < $count_trang)
								<button type="button" onclick="location.href='{{ route('khoa_hoc.view_all',[
										'trang' => $next, 
										'ma_khoa_hoc' => $ma_khoa_hoc
										]) }}" style="font-weight:bold; color: black " >
									>
								</button>
								<button type="button" onclick="location.href='{{ route('khoa_hoc.view_all',[
										'trang' => $count_trang, 
										'ma_khoa_hoc' => $ma_khoa_hoc
										]) }}'" >
									Cuối
								</button>
							@endif 
						</td>
					</tr>
				</tfoot>
			</table>			
		</div>
		<div class="modal fade" id="addModal" role="dialog">
	    	<div class="modal-dialog">
		      	<div class="card modal-content">
			        <div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal">&times;</button>
			          	<h3 class="card-title">Thêm khóa học</h3>
			        </div>
			        <div class="modal-body">
				        <form action="{{route('khoa_hoc.process_insert')}}" method="post" id="form_insert">
				        	{{csrf_field()}}
			                <div class="row">
                                <label class="col-sm-3 col-form-label" style="margin-top: 1%;font-size: 1.75rem; font-weight: normal">Tên khóa học</label>
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
			          	<button type="button" class="btn btn-default btn-sm btn-round" data-dismiss="modal">Close</button>
			        </div>
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
			        <form action="{{route('khoa_hoc.process_update', ['ma_khoa_hoc' => $khoa_hoc->ma_khoa_hoc])}}" method="post" id="form_update">
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
		        	<input type="button" class="btn btn-fill btn-info btn-sm btn-round" value="Sửa" onclick="validate_update()">
		          	<button type="button" class="btn btn-default btn-sm btn-round" data-dismiss="modal">Close</button>
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
  	
