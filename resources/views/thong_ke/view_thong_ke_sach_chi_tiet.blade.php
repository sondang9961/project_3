@extends('layer.master')
@section('pageTitle', 'Thống kê sách chi tiết')
@section('content')
	<div class="card">
		<h2 style="padding: 1%">Danh sách sinh viên đã nhận sách <b>{{$array_thong_ke_sach[0]->ten_sach}}</b> </h2>	
		<div class="content">
			<div class="toolbar">
				<form>
					{{-- <table>
						<tr>
							<td>
								<b>Tên lớp</b>
							</td>
							<td style="padding-bottom: 4%">
								<select name="ma_lop" class="form-control" style="width: 17rem">
									<option disabled selected value="">--Chọn lớp--</option>
									@foreach ($array_lop as $lop)
										<option value="{{$lop->ma_lop}}"
											@if ($lop->ma_lop == $ma_lop)
												selected 
											@endif
											>
											{{$lop->ten_lop}}
										</option>
									@endforeach
								</select>
							</td>
							<td>
								<input type="submit" class="btn btn-info btn-round btn-sm btn-fill" value="Xem"style="margin-left: 25px">
							</td>
						</tr>
					</table> --}}			
				</form>
			</div>
			<table class="table table-striped" style="width: 70%" >
				<thead>
					<tr>
						<th>Mã sinh viên</th>
						<th>Tên sinh viên</th>
						<th>Tên lớp</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($array_thong_ke_sach as $thong_ke)
						<tr>
							<td>{{$thong_ke->ma_sinh_vien}}</td>
							<td>{{$thong_ke->ten_sinh_vien}}</td>
							<td>{{$thong_ke->ten_lop}}</td>
						</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td colspan="100%"> 
							{{-- {!! $array_thong_ke_sach->render()!!} --}}
							<button class='button_update btn btn-info btn-fill btn-wd center-block' onclick="goBack()">Quay lại</button>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>

@endsection
@push('js')
<script>
	function goBack() {
	  window.history.back();
	}
</script>
@endpush
