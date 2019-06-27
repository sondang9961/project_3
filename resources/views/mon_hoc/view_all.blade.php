@extends('layer.master')
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
	<center><h1>Quản lý môn học</h1></center>
	<div id="main_content">
		<div id="left_content">
			<div><h2>Danh sách môn học</h2></div>
			<form>
				Khóa học
				<select name="ma_khoa_hoc" id="search_khoa_hoc" style="width:16rem">
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
							<input type="submit" value="Cập nhật">
						</td>
					</tr>
				</form>
				@endforeach
			</table>
		</div>
		<div id="right_content">
			<div><h2>Thêm môn học</h2></div>
				<div>
					<form action="{{route('mon_hoc.process_insert')}}" method="post">
						{{csrf_field()}}
						<div>Tên môn</div>	
						<div><input type="text" name="ten_mon_hoc" id="textbox"></div><br>
						<div>Khóa học</div>
						<div>
							<select name="ma_khoa_hoc" id="select_khoa_hoc" style="width: 16.5rem">
								<option>--Tên khóa học--</option>
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
@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script type="text/javascript">
	$("#search_khoa_hoc").select2();
	$("#select_khoa_hoc").select2();
</script>
@endpush