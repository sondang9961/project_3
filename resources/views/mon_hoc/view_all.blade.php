@extends('layer.master')
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
	<center><h1 id="header">Quản lý môn học</h1></center>
	<div id="main_content">
		<div id="left_content">
			<div><h2>Danh sách môn học</h2></div>
			<form>
				Khóa học
				<select name="ma_khoa_hoc" id="search_khoa_hoc" style="width:16rem">
					<option value="">Xem tất cả</option>
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
						<th>Tên môn</th>
						<th>Khóa học</th>
						<th colspan="2">Chức năng</th>
					</tr>
				</thead>				
				@foreach ($array_mon_hoc as $mon_hoc)
				<form action="{{route('mon_hoc.process_update', ['ma_mon_hoc' => $mon_hoc->ma_mon_hoc])}}" method="post">
					{{csrf_field()}}
					<tr>
						<td>{{$mon_hoc->ma_mon_hoc}}</td>
						<td>{{$mon_hoc->ten_mon_hoc}}</td>
						<td>{{$mon_hoc->ten_khoa_hoc}}</td>
						<td>
							<input type="button" class='button_update' value="Cập nhật" data-toggle="modal" data-target="#myModal" data-ma_mon_hoc='{{$mon_hoc->ma_mon_hoc}}'>
						</td>
					</tr>
				</form>
				@endforeach
				<tfoot>
					<tr>
						<td colspan="100%">
							Trang: 
							@if ($trang > 1)
								<button type="button" onclick="location.href='{{ route('mon_hoc.view_all',[
										'trang' => 1,
										'ma_khoa_hoc' => $ma_khoa_hoc
									]) }}'"				
								>
									Đầu
								</button>
								<a href="{{ route('mon_hoc.view_all',[
										'trang' => $prev, 
										'ma_khoa_hoc' => $ma_khoa_hoc
									]) }}" style="font-weight:bold; color: black" >
									<<
								</a>
							@endif
							@if ($count_trang > 7)
								@for ($i = $startpage; $i <= $endpage; $i++)
									<button type="button" onclick="location.href='{{ route('mon_hoc.view_all',[
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
									<button type="button" onclick="location.href='{{ route('mon_hoc.view_all',[
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
								<a href="{{ route('mon_hoc.view_all',[
										'trang' => $next, 
										'ma_khoa_hoc' => $ma_khoa_hoc
										]) }}" style="font-weight:bold; color: black " >
									>>
								</a>
								<button type="button" onclick="location.href='{{ route('mon_hoc.view_all',[
										'trang' => $count_trang, 
										'ma_khoa_hoc' => $ma_khoa_hoc
										]) }}'">
									Cuối
								</button>
							@endif 
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
		<div id="right_content">
			<div><h2>Thêm môn học</h2></div>
				<div>
					<form action="{{route('mon_hoc.process_insert')}}" method="post" id="form_insert">
						{{csrf_field()}}
						<div>Tên môn</div>	
						<div>
							<input type="text" name="ten_mon_hoc" id="mon_hoc">
							<span id="errMonHoc" style="color: red"></span>
						</div><br>
						<div>Khóa học</div>
						<div>
							<select name="ma_khoa_hoc" id="select_khoa_hoc" style="width: 16.5rem">
								<option value="-1">--Tên khóa học--</option>
								@foreach ($array_khoa_hoc as $khoa_hoc)
									<option value="{{$khoa_hoc->ma_khoa_hoc}}">
										{{$khoa_hoc->ten_khoa_hoc}}
									</option>			
								@endforeach
							</select>
							<span id="errKhoaHoc" style="color: red"></span>
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
		          	<h4 class="modal-title">Cập nhật môn học</h4>
		        </div>
		        <div class="modal-body">
			        <form action="{{route('mon_hoc.process_update', ['ma_mon_hoc' => $mon_hoc->ma_mon_hoc])}}" method="post" id="form_update">
			        	{{csrf_field()}}
			          	<input type="hidden" name="ma_mon_hoc" id="ma_mon_hoc">
			          	Tên môn học<br>
			          	<input type="text" name="ten_mon_hoc" id="ten" class="form-control"><br>
			          	<span id="errTen" style="color: red"></span><br>
			          	Khóa học<br>
			          	<select name="ma_khoa_hoc" id="ma_khoa_hoc">
			          		@foreach($array_khoa_hoc as $khoa_hoc)
								<option value="{{$khoa_hoc->ma_khoa_hoc}}">
									{{$khoa_hoc->ten_khoa_hoc}}
								</option>
							@endforeach
			          	</select>
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
				$("#ma_khoa_hoc").val(response.ma_khoa_hoc);
			})
			.fail(function() {
				console.log("error");
			});
			
		});
	});
	function validate() {
		var dem = 0;
		var mon_hoc = document.getElementById('mon_hoc').value;
		var ma_khoa_hoc = document.getElementById('select_khoa_hoc').value;
		var errMonHoc= document.getElementById('errMonHoc');
		var errKhoaHoc = document.getElementById('errKhoaHoc');

		if(mon_hoc.length == 0){
			errMonHoc.innerHTML="Không được trống!";
		}else {
			errMonHoc.innerHTML="";
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
		var errTen= document.getElementById('errTen');

		if(ten.length == 0){
			errTen.innerHTML="Không được trống!";
		}else {
			document.getElementById('form_update').submit();
		}
	}
</script>
@endpush