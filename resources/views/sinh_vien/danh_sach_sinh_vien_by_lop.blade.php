@extends('layer.master')
@section('pageTitle', "Danh sách sinh viên lớp {$array_sinh_vien[0]->ten_lop}")
@section('content')
	<div class="card">
		<h2 style="padding: 1%">Danh sách sinh viên lớp {{$array_sinh_vien[0]->ten_lop}}</h2>
		<div class="content">
			<h6>Sỹ số: 
				@if (count($array_sinh_vien)>0)
					{{$array_sinh_vien[0]->sy_so}}
				@else
					0
				@endif
			</h6>	
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Mã</th>
						<th>Tên sinh viên</th>
						<th>Ngày sinh</th>
						<th>Email</th>
						<th>Số điện thoại</th>
						<th>Địa chỉ</th>
						<th>Tên lớp</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($array_sinh_vien as $sinh_vien)
						<tr>
							<td>{{$sinh_vien->ma_sinh_vien}}</td>
							<td>{{$sinh_vien->ten_sinh_vien}}</td>
							<td>{{date_format(date_create($sinh_vien->ngay_sinh),'d/m/Y')}}</td>
							<td>{{$sinh_vien->email}}</td>
							<td>{{$sinh_vien->sdt}}</td>
							<td>{{$sinh_vien->dia_chi}}</td>
							<td>{{$sinh_vien->ten_lop}}</td>			
						</tr>		
					@endforeach
				</tbody>				
				<tfoot>
					<tr>
						<td colspan="100%">
							{!! $array_sinh_vien->render() !!}			
						</td>
					</tr>
				</tfoot>
			</table>
			<button class='button_update btn btn-info btn-fill btn-wd center-block' onclick="location.href='{{ route('lop.view_all') }}'">Quay lại</button>
		</div>
	</div>
@endsection
@push('js')
@endpush