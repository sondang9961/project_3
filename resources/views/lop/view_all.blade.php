@extends('layer.master')
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<center><h1>Quản lý lớp</h1></center>
	<div id="main_content">
		<div id="left_content" >
			<div><h2>Danh sách lớp</h2></div>
			<form>
				Khóa học
				<select name="ma_khoa_hoc" style="width: 16.5rem" id="search_khoa_hoc">
					<option>--Tên khóa học--</option>
					@foreach($array_khoa_hoc as $khoa_hoc)
						<option value="{{$khoa_hoc->ma_khoa_hoc}}">
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
						<th colspan="2">Chức năng</th>
					</tr>
				</thead>
				@foreach ($array_lop as $lop)		
					<tr>
						<td>{{$lop->ma_lop}}</td>
						<td>{{$lop->ten_lop}}</td>
						<td>{{$lop->ten_khoa_hoc}}</td>
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
							@for ($i = 1; $i <= $count_trang; $i++)
								<a href="{{ route('lop.view_all',['trang' => $i]) }}">
									{{$i}}
								</a>
							@endfor
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
						<div><input type="text" name="ten_lop" id="textbox" placeholder="Tên lớp + K(1,2,3...)"></div><br>
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
		          	<h4 class="modal-title">Cập nhật lớp</h4>
		        </div>
		        <div class="modal-body">
			        <form action="{{route('lop.process_update', ['ma_lop' => $lop->ma_lop])}}" method="post">
			        	{{csrf_field()}}
			          	<input type="hidden" name="ma_lop" id="ma_lop">
			          	Tên lớp<br>
			          	<input type="text" name="ten_lop" id="ten_lop" class="form-control"><br>
			          	Khóa học<br>
			          	<select name="ma_khoa_hoc">
			          		@foreach($array_khoa_hoc as $khoa_hoc)
								<option value="{{$khoa_hoc->ma_khoa_hoc}}" 
									@if ($lop->ma_khoa_hoc == $khoa_hoc->ma_khoa_hoc) 
										selected
									@endif
								>
									{{$khoa_hoc->ten_khoa_hoc}}
								</option>
							@endforeach
			          	</select>						
			        	<input type="submit" value="Sửa" class="btn-sm">
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
				$("#ten_lop").val(response.ten_lop);
			})
			.fail(function() {
				console.log("error");
			});
			
		});
	});
</script>
@endpush