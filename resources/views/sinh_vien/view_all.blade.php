@extends('layer.master')
@push('css')
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
	<div id="main_content">
		<center><h1 id="header">Quản lý sinh viên</h1></center>
		<div id="left_content">
			<div><h2>Danh sách sinh viên</h2></div>
			<form>
				Lớp
				<select name="ma_lop" id="search_lop" style="width: 10rem">
					<option value="">Xem tất cả</option>
					@foreach($array_lop as $lop)
						<option value="{{$lop->ma_lop}}"
						@if ($lop->ma_lop == $ma_lop)
							selected 
						@endif
						>
							{{$lop->ten_lop}}
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
						<th>Tên sinh viên</th>
						<th>Tên lớp</th>
						<th colspan="2">Chức năng</th>
					</tr>
				</thead>				
				@foreach ($array_sinh_vien as $sinh_vien)
				<form action="" method="post">
				{{csrf_field()}}
				<tr>
					<td>{{$sinh_vien->ma_sinh_vien}}</td>
					<td>{{$sinh_vien->ten_sinh_vien}}</td>
					<td>{{$sinh_vien->ten_lop}}</td>
					<td>
						<input type="button" class='button_update' value="Cập nhật" data-toggle="modal" data-target="#myModal" data-ma_sinh_vien='{{$sinh_vien->ma_sinh_vien}}'>		
					</td>				
				</tr>
				</form>
				@endforeach
				<tfoot>
					<tr>
						<td colspan="100%">
							Trang: 
							@if ($trang > 1)
								<button type="button" onClick="location.href='{{ route('sinh_vien.view_all',['trang' => 1, 'ma_lop' => $ma_lop]) }}'">
									Đầu
								</button>
								<button type="button" onClick="location.href='{{ route('sinh_vien.view_all',['trang' => $prev, 'ma_lop' => $ma_lop]) }}'">
									Trước
								</button>
							@endif
							@if ($count_trang > 7)
								@for ($i = $startpage; $i <= $endpage; $i++)
									<button type="button" onClick="location.href='{{ route('sinh_vien.view_all',['trang' => $i, 'ma_lop' => $ma_lop]) }}'">
										{{$i}}
									</button>
								@endfor
							@else
								@for ($i = 1; $i <= $count_trang; $i++)
									<button type="button" onClick="location.href='{{ route('sinh_vien.view_all',['trang' => $i, 'ma_lop' => $ma_lop]) }}'">
										{{$i}}
									</button>
								@endfor
							@endif
							@if ($trang < $count_trang)
								<button type="button" onClick="location.href='{{ route('sinh_vien.view_all',['trang' => $next, 'ma_lop' => $ma_lop]) }}'">
									Sau
								</button>
								<button type="button" onClick="location.href='{{ route('sinh_vien.view_all',['trang' => $count_trang, 'ma_lop' => $ma_lop]) }}'">
									Cuối
								</button>
							@endif
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
		<div id="right_content" >
			<div><h2>Thêm sinh viên</h2></div>
				<div>
					<form action="{{ route('sinh_vien.process_insert')}}" method="post" id="form_insert">
						{{csrf_field()}}
						<div>Tên sinh viên</div>	
						<div>
							<input type="text" name="ten_sinh_vien" id="sinh_vien" >
							<span id="errSinhVien" style="color: red"></span>
						</div><br>
						<div>Tên lớp</div>
						<div>
							<select name="ma_lop" style="width: 16.5rem" id="select_lop">
								<option value="-1">--Tên lớp--</option>
								@foreach($array_lop as $lop)
									<option value="{{$lop->ma_lop}}">
										{{$lop->ten_lop}}
									</option>
								@endforeach
							</select>
							<span id="errLop" style="color: red"></span>
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
		          	<h4 class="modal-title">Cập nhật sinh viên</h4>
		        </div>
		        <div class="modal-body">
			        <form action="{{route('sinh_vien.process_update', ['ma_sinh_vien' => $sinh_vien->ma_sinh_vien])}}" method="post">
			        	{{csrf_field()}}
			          	<input type="hidden" name="ma_sinh_vien" id="ma_sinh_vien">
			          	Tên sinh viên<br>
			          	<input type="text" name="ten_sinh_vien" id="ten_sinh_vien" class="form-control"><br>
			          	Lớp
			          	<select name="ma_lop" id="ma_lop">
			          		@foreach($array_lop as $lop)
								<option value="{{$lop->ma_lop}}">
									{{$lop->ten_lop}}
								</option>
							@endforeach
			          	</select>						
			        	<div style="margin-top: 2rem">
			          		<input type="submit" value="Sửa" class="btn-sm">
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
	$("#search_lop").select2();
	$("#select_lop").select2();
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
				$("#ten_sinh_vien").val(response.ten_sinh_vien);
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
</script>
@endpush