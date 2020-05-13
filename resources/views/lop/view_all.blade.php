@extends('layer.master')
@section('pageTitle', 'Quản lý lớp')
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<center><h1 id="header">Quản lý lớp</h1></center>
	<div id="main_content">
		<div id="left_content" >
			<div><h2>Danh sách lớp</h2></div>
			<form>
				Khóa học
				<select name="ma_khoa_hoc" style="width: 16.5rem" id="search_khoa_hoc">
					<option value="">Xem Tất Cả</option>
					@foreach($array_khoa_hoc as $khoa_hoc)
						<option value="{{$khoa_hoc->ma_khoa_hoc}}"
						@if ($khoa_hoc->ma_khoa_hoc == $ma_khoa_hoc)
							selected 
						@endif
						>
							{{$khoa_hoc->ten_khoa_hoc}}
						</option>
					@endforeach
				</select>
				<input type="submit" value="Xem" id="button">
			</form>
			<br>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Mã</th>
						<th>Tên lớp</th>
						<th>Khóa học</th>
						<th>Sỹ số</th>
						<th colspan="2">Chức năng</th>
					</tr>
				</thead>
				@foreach ($array_lop as $lop)		
					<tr>
						<td>{{$lop->ma_lop}}</td>
						<td>{{$lop->ten_lop}}</td>
						<td>{{$lop->ten_khoa_hoc}}</td>
						<td>{{$lop->sy_so}}</td>
						<td>
							<input type="button" class='button_update' value="Cập nhật" data-toggle="modal" data-target="#myModal" data-ma_lop='{{$lop->ma_lop}}'>
						</td>
						<td>
							<button style="width:100%" onclick="location.href='{{route('sinh_vien.danh_sach_sinh_vien_by_lop', ['ma_lop' => $lop->ma_lop])}}'">Danh sách SV</button>
						</td>
					</tr>
				@endforeach
				<tfoot>
					<tr>
						<td colspan="100%">
							Trang:
							@if ($trang > 1)
								<button type="button" onclick="location.href='{{ route('lop.view_all',[
										'trang' => 1,
										'ma_khoa_hoc' => $ma_khoa_hoc
									]) }}'" 				
								>
									Đầu
								</button>
								<button type="button" onclick="location.href='{{ route('lop.view_all',[
										'trang' => $prev, 
										'ma_khoa_hoc' => $ma_khoa_hoc
									]) }}'" style="font-weight:bold; color: black" >
									<
								</button>
							@endif
							@if ($count_trang > 7)
								@for ($i = $startpage; $i <= $endpage; $i++)
									<button type="button" onclick="location.href='{{ route('lop.view_all',[
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
									<button type="button" onclick="location.href='{{ route('lop.view_all',[
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
								<button type="button" onclick="location.href='{{ route('lop.view_all',[
										'trang' => $next, 
										'ma_khoa_hoc' => $ma_khoa_hoc
										]) }}" style="font-weight:bold; color: black " >
									>
								</button>
								<button type="button" onclick="location.href='{{ route('lop.view_all',[
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
		<div id="right_content">
			<div><h2>Thêm lớp</h2></div>
				<div>
					<form action="{{ route('lop.process_insert')}}" method="post" id="form_insert">
						{{csrf_field()}}
						<div>Tên lớp</div>	
						<div>
							<input type="text" name="ten_lop" id="lop" placeholder="bkc + (01,...) + k(1,...)">
							<span id="errLop" style="color: red"></span>
						</div>
						<br>
						<div>Khóa học</div>
						<div>
							<select name="ma_khoa_hoc" id="select_khoa_hoc" style="width: 16.5rem">
								<option value="-1" disabled selected>--Tên khóa học--</option>
								@foreach ($array_khoa_hoc as $khoa_hoc) 
									<option value="{{$khoa_hoc->ma_khoa_hoc}}">
										{{$khoa_hoc->ten_khoa_hoc}}
									</option>
								@endforeach 								
							</select>
							<span id="errKhoaHoc" style="color: red"></span>
						</div>
						<br>
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
						</div><br>
						<div><input type="button" value="Thêm" id="button" onclick="validate()"></div>
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
		          	<h4 class="modal-title">Cập nhật lớp</h4>
		        </div>
		        <div class="modal-body">
			        <form action="{{route('lop.process_update', ['ma_lop' => $lop->ma_lop])}}" method="post" id="form_update">
			        	{{csrf_field()}}
			          	<input type="hidden" name="ma_lop" id="ma_lop">
			          	Tên lớp<br>
			          	<input type="text" name="ten_lop" id="ten" class="form-control"><br>
			          	<span id="errTen" style="color: red"></span>
			          	<br>
			          	Khóa học<br>
			          	<select name="ma_khoa_hoc" id="ma_khoa_hoc">
			          		@foreach($array_khoa_hoc as $khoa_hoc)
								<option value="{{$khoa_hoc->ma_khoa_hoc}}">
									{{$khoa_hoc->ten_khoa_hoc}}
								</option>
							@endforeach
			          	</select>
			          	<br>					
			        	<div style="margin-top: 2rem">
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
			})
			
		});
	});
	function validate() {
		var dem = 0;
		var lop = document.getElementById('lop').value;
		var ma_khoa_hoc = document.getElementById('select_khoa_hoc').value;
		var errLop = document.getElementById('errLop');
		var errKhoaHoc = document.getElementById('errKhoaHoc');

		if(lop.length == 0){
			errLop.innerHTML="Không được trống!";
		}else {
			errLop.innerHTML="";
			dem++;
		}
		if(ma_khoa_hoc == -1){
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
		var errTen = document.getElementById('errTen');

		if(ten.length == 0){
			errTen.innerHTML="Không được trống!";
		}else {
			document.getElementById('form_update').submit();
		}
	}
</script>
@endpush