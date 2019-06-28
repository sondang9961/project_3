@extends('layer.master')
@push('css')
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')

	<center><h1>Quản lý sinh viên</h1></center>
	<div id="main_content">
		<div id="left_content">
			<div><h2>Danh sách sinh viên</h2></div>
			<form>
				Lớp
				<select name="ma_lop" id="search_lop" style="width: 10rem">
					<option>--Tên lớp--</option>
					@foreach($array_lop as $lop)
						<option value="{{$lop->ma_lop}}">
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
			</table>
		</div>
		<div id="right_content" >
			<div><h2>Thêm sinh viên</h2></div>
				<div>
					<form action="{{ route('sinh_vien.process_insert')}}" method="post">
						{{csrf_field()}}
						<div>Tên sinh viên</div>	
						<div><input type="text" name="ten_sinh_vien" id="textbox" ></div><br>
						<div>Tên lớp</div>
						<div>
							<select name="ma_lop" style="width: 16.5rem" id="select_lop">
								<option>--Tên lớp--</option>
								@foreach($array_lop as $lop)
									<option value="{{$lop->ma_lop}}">
										{{$lop->ten_lop}}
									</option>
								@endforeach
							</select>
						</div><br>
						<div><input type="submit" value="Thêm" id="button"></div>
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
</script>
@endpush