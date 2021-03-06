@extends('layer.master')
@section('pageTitle', 'Thống kê sinh viên')
@push('css')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
	<div class="card">	
		<h2 style="padding: 1%">Thống kê sinh viên chưa đăng ký sách</h2>
		<div class="content">
			<div class="toolbar">
				<form>
					<table>
						<tr>
							<td style="padding-bottom: 4%">
								<div style="margin-right: 3rem ">Khóa học
									<select name="ma_khoa_hoc" class="form-control" style="width: 14rem" id="search_khoa_hoc">
										<option selected disabled>--Tên khóa học--</option>
										@foreach ($array_khoa_hoc as $khoa_hoc)
											<option value="{{$khoa_hoc->ma_khoa_hoc}}"
											@if ($khoa_hoc->ma_khoa_hoc == $ma_khoa_hoc)
												selected 
											@endif		
											>
												{{$khoa_hoc->ten_khoa_hoc}}
											</option>
										@endforeach
									</select>
								</div>
							</td>
							<td style="padding-bottom: 4%">
								<div style="margin-right: 3rem ">Tên lớp
									<select name="ma_lop" class="form-control" style="width: 14rem" id="search_lop">
										<option selected disabled>--Tên lớp--</option>
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
								</div>
							</td>
							<td style="padding-bottom: 4%">
								<div style="margin-right: 3rem ">Tên sách
									<select name="ma_sach" class="form-control" style="width: 14rem" id="searchSach">
										<option selected disabled>--Tên sách--</option>
										@foreach ($array_sach as $sach)
											<option value="{{$sach->ma_sach}}"
											@if ($sach->ma_sach == $ma_sach)
												selected 
											@endif
											>
												{{$sach->ten_sach}}
											</option>
										@endforeach
									</select>
								</div>
							</td>
							<td style="padding-bottom: 5%">
								<input type="submit" class="btn btn-info btn-round btn-sm btn-fill" value="Xem">
							</td>
							<td style="padding-bottom: 5%; padding-left: 5px">
								@if (isset($ma_lop) && isset($ma_sach) && count($array_thong_ke_sinh_vien) > 0)
									<a style="margin-left: 5px; color: green; border: 1px green solid" class="btn btn-primary btn-round btn-sm btn-outline" href="{{ route('thong_ke.export_thong_ke_sinh_vien',['ma_lop' => $ma_lop, 'ma_sach' => $ma_sach]) }}">
										Xuất file excel
									</a>
									<a class="btn btn-danger btn-round btn-sm btn-outline" href="{{ route('thong_ke.export_pdf_thong_ke_sinh_vien',['ma_lop' => $ma_lop, 'ma_sach' => $ma_sach]) }}" style="margin-left: 5px">
										Xuất file pdf
									</a>
								@endif
							</td>
						</tr>
					</table>
				</form>
			</div>
			@if(!isset($ma_sach) && isset($ma_lop))
				<div class="alert alert-danger alert-block">
					Bạn chưa chọn sách
					<button type="button" aria-hidden="true" class="close" data-dismiss="alert">
                        <i class="pe-7s-close"></i>
                    </button>
		   		</div>
			@endif
			@if(!isset($ma_lop) && !isset($ma_sach) && isset($ma_khoa_hoc))
				<div class="alert alert-danger alert-block">
					Bạn chưa chọn lớp và sách
					<button type="button" aria-hidden="true" class="close" data-dismiss="alert">
                        <i class="pe-7s-close"></i>
                    </button>
		   		</div>
			@endif
			@if (count($array_thong_ke_sinh_vien) > 0)
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
						@foreach ($array_thong_ke_sinh_vien as $thong_ke)
							<tr>
								<td>{{$thong_ke->ma_sinh_vien}}</td>
								<td>{{$thong_ke->ten_sinh_vien}}</td>
								<td>{{date_format(date_create($thong_ke->ngay_sinh),'d/m/Y')}}</td>
								<td>{{$thong_ke->email}}</td>
								<td>{{$thong_ke->sdt}}</td>
								<td>{{$thong_ke->dia_chi}}</td>
								<td>{{$thong_ke->ten_lop}}</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td colspan="100%">
								{!! $array_thong_ke_sinh_vien->render()!!}
							</td>
						</tr>
					</tfoot>
				</table>
			@elseif(isset($ma_sach) && isset($ma_lop))
				<center><h4>Tất cả sinh viên của lớp đã đăng ký sách</h4></center>
			@endif			
		</div>
	</div>

@endsection
@push('js')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#search_khoa_hoc").select2();

		$("#search_lop").select2({
			ajax: {
				url: '{{route('get_lop_by_khoa_hoc')}}',
				dataType: 'json',
				data: function() {
					ma_khoa_hoc = $("#search_khoa_hoc").val();
					return {
						ma_khoa_hoc: ma_khoa_hoc
					}
				},
				processResults: function (data){
					return {
						results: $.map(data, function(item) {
							return  {
								text: item.ten_lop,
								id: item.ma_lop
							}
						})
					};
				}
			}
		});	

		$("#searchSach").select2({
			ajax: {
				url: '{{route('get_sach_by_khoa_hoc_and_lop')}}',
				dataType: 'json',
				data: function() {
					ma_lop = $("#search_lop").val();
					ma_khoa_hoc = $("#search_khoa_hoc").val();
					return {
						ma_lop: ma_lop,
						ma_khoa_hoc: ma_khoa_hoc
					}
				},
				processResults: function (data){
					return {
						results: $.map(data, function(item) {
							return  {
								text: `${item.ten_sach} - ${item.ten_khoa_hoc}`,
								id: item.ma_sach
							}
						})
					};
				}
			}
		});		
	});
</script>
@endpush