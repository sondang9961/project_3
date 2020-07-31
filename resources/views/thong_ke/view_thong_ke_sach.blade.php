@extends('layer.master')
@section('pageTitle', 'Thống kê sách')
@section('content')
	<div class="card">
		<h2 style="padding: 1%">Thống kê sách</h2>	
		<div class="content">
			<div class="toolbar">
				<form>
					<table>
						<tr>
							<td style="padding-bottom: 4%">
								<div style="margin-right: 3rem ">Tìm kiếm<br>
									<input type="text" name="search" placeholder="sách, môn học" value="{{ Request::get('search') }}" style="height: 3.8rem">
								</div>
							</td>
							<td style="padding-bottom: 4%">
								Ngày nhập
								<table>
									<tr>
										<td>
											Từ &nbsp
										</td>
										<td>
											<input type="date" id="start" name="start" class="form-control" value="{{ Request::get('start') }}">
										</td>
										<td>&nbsp đến &nbsp</td>
										<td>
											<input type="date" id="end" name="end" class="form-control" value="{{ Request::get('end') }}">	
										</td>
									</tr>
								</table>
							</td>
							<td style="padding-bottom: 12px">
								<input type="submit" class="btn btn-info btn-round btn-sm btn-fill" value="Xem"style="margin-left: 25px">
							</td>
							<td style="padding-bottom: 12px">
								@if (!empty($search) || !empty($start) || !empty($end) && $start < $end)
									@if(count($array_thong_ke_sach) > 0)
										<a style="margin-left: 5px; color: green; border: 1px green solid" class="btn btn-primary btn-round btn-sm btn-outline" href="{{ route('thong_ke.export_thong_ke_sach',['search' => $search, 'start' => $start, 'end' => $end]) }}">
											Xuất file excel
										</a>
										<a class="btn btn-danger btn-round btn-sm btn-outline" href="{{ route('thong_ke.export_pdf_thong_ke_sach',['search' => $search, 'start' => $start, 'end' => $end]) }}" style="margin-left: 5px">
											Xuất file pdf
										</a>
									@endif
								@endif
							</td>
						</tr>
					</table>			
				</form>
			</div>
			@if(count($array_thong_ke_sach) > 0)
			@if (isset($search) || isset($start) || isset($end))
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Tên sách</th>
							<th>Ngày nhập</th>
							<th>Số lượng nhập</th>
							<th>Số lượng đã phát</th>
							<th>Số lượng tồn kho</th>
							<th>Chi tiết</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($array_thong_ke_sach as $thong_ke)
							<tr>
								<td>{{$thong_ke->ten_sach}}</td>
								<td>{{date_format(date_create($thong_ke->ngay_nhap_sach),'d/m/Y')}}</td>
								<td>{{$thong_ke->so_luong_nhap}}</td>
								<td>{{$thong_ke->so_luong_da_phat}}</td>
								<td>{{$thong_ke->so_luong_ton_kho}}</td>
								<td>
									<a class="btn btn-primary btn-round btn-sm btn-fill" href="{{ route('thong_ke.view_thong_ke_sach_chi_tiet', ['ma_sach' => $thong_ke->ma_sach]) }}" target="_blank">Những sinh viên đã nhận sách</a>
								</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td colspan="100%"> 
								{!! $array_thong_ke_sach->render()!!}
							</td>
						</tr>
					</tfoot>
				</table>
			@endif
			@else
				<h4><center>{{ $message}}</center></h4>	
			@endif
		</div>
	</div>

@endsection
