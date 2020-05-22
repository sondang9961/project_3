@extends('layer.master')
@section('content')
	<div class="card">
		<h2 style="padding: 1%">Danh sách sinh viên lớp {{$array_sinh_vien[0]->ten_lop}}</h2>
		<div class="content">
			<h6>Sỹ số: {{$array_sinh_vien[0]->sy_so}}</h6>	
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Mã</th>
						<th>Tên sinh viên</th>
						<th>Tên lớp</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($array_sinh_vien as $sinh_vien)
						<tr>
							<td>{{$sinh_vien->ma_sinh_vien}}</td>
							<td>{{$sinh_vien->ten_sinh_vien}}</td>
							<td>{{$sinh_vien->ten_lop}}</td>			
						</tr>
				<tr>			
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