@extends('layer.master')
@push('css')
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
@endpush
@section('content')
<center><h1>Quản lý khóa học</h1></center>
	<div id="main_content">
		<div id="left_content">
			<div><h2>Danh sách khóa học</h2></div>
			<form action="{{route('khoa_hoc.process_update')}}">
				<table class="table table-striped">
					<tr>
						<th>Mã</th>
						<th>Tên khóa học</th>
						<th>Chức năng</th>
					</tr>
					@foreach ($array_khoa_hoc as $khoa_hoc)
					<tr>
						<td>{{$khoa_hoc->ma_khoa_hoc}}</td>
						<td><input type="text" name="ten_khoa_hoc" value="{{$khoa_hoc->ten_khoa_hoc}}"></td>
						<td>
							<a href="{{route('khoa_hoc.view_update',['ma_khoa_hoc' => $khoa_hoc->ma_khoa_hoc])}}">
								<button class="btn btn-warning btn-simple btn-icon " data-toggle="modal" data-target="#myModal">	<i class="fa fa-edit"></i>
								</button>
							</a>
						</td>
					</tr>
				@endforeach
			</form>			
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
@endsection
@push('js')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
@endpush