@extends('layer.master')
@push('css')
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
@endpush
@section('content')
<font face="Roboto,Helvetica Neue,Arial,sans-serif">
<center><h1>Quản lý khóa học</h1></center>
	<div id="main_content">
		<div id="left_content">
			<div><h2>Danh sách khóa học</h2></div>	
			<table class="table table-striped">
				<tr>
					<th>Mã</th>
					<th>Tên khóa học</th>
					<th>Chức năng</th>
				</tr>
				@foreach ($array_khoa_hoc as $khoa_hoc)
				<form action="{{route('khoa_hoc.process_update', ['ma_khoa_hoc' => $khoa_hoc->ma_khoa_hoc])}}" method="post">
					{{csrf_field()}}
					<tr>
						<td>{{$khoa_hoc->ma_khoa_hoc}}</td>
						<td><input type="text" name="ten_khoa_hoc" value="{{$khoa_hoc->ten_khoa_hoc}}"></td>
						<td>
							<input type="submit" value="Cập nhật">
						</td>
					</tr>
				</form>
				@endforeach
			</table>			
		</div>
		<div id="right_content" >
			<div><h2>Thêm khóa học</h2></div>
				<div>
					<form action="{{route('khoa_hoc.process_insert')}}" method="post">
						{{csrf_field()}}
						<div>Tên khóa học</div>	
						<div><input type="text" name="ten_khoa_hoc" id="textbox"></div><br>
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
		          	<h4 class="modal-title">Cập nhật khóa học</h4>
		        </div>
		        <div class="modal-body">
			        <form>
			          	Tên khóa học <input type="text" name="ten_khoa_hoc" value="" />
			        	<button>Sửa</button>
			        </form>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        </div>
	      	</div>
    	</div>
  	</div>
</font>
@endsection
@push('js')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
@endpush