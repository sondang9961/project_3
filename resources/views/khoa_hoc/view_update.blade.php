@extends('layer.master')
@section('content')
	<div><h2>Sửa khóa học</h2></div>
		<div>
			<form action="{{route('khoa_hoc.process_update', ['ma_khoa_hoc' => $array_khoa_hoc->ma_khoa_hoc])}}" method="post">
				{{csrf_field()}}
				<div>Tên khóa học</div>	
				<input type="hidden" name="ma_khoa_hoc" value="{{$array_khoa_hoc->ma_khoa_hoc}}">
				<div><input type="text" name="ten_khoa_hoc" id="textbox" value="{{$array_khoa_hoc->ten_khoa_hoc}}"></div><br>
				<div><input type="submit" value="Sửa" id="button"></div>
			</form>
		</div>
@endsection
