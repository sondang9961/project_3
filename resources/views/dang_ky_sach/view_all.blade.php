@extends('layer.master')
@section('pageTitle', 'Quản lý đăng ký sách')
@push('css')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
	<div class="card">
		<h2 style="padding: 1%">Danh sách đăng ký</h2>
		<div class="content">
			<div class="toolbar">
				<form>
					<table style="width: 90%">
						<tr style="height: 4rem">
							<td>
								<b>Tên lớp</b>
							</td>
							<td>
								<select name="ma_lop" class="form-control" style="width: 18rem" id="search_lop" >
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
								<b>Tên sinh viên</b>
							</td>
							<td>
								<select name="ma_sinh_vien" class="form-control" style="width: 17rem" id="search_sinh_vien" disabled>
									<option>--Sinh viên--</option>
									@foreach ($array_sinh_vien as $sinh_vien)
										<option value="{{$sinh_vien->ma_sinh_vien}}"
											@if ($sinh_vien->ma_sinh_vien == $ma_sinh_vien)
												selected 
											@endif
										>
											{{$sinh_vien->ten_sinh_vien}}
										</option>
									@endforeach
								</select>
							</td>
						
							<td>
								<input type="submit" class="btn btn-info btn-round btn-sm btn-fill" value="Xem" id="button" disabled>								
								<input type="button" class="btn btn-round btn-sm btn-fill" value="Hủy tìm kiếm" onclick="location.href='{{ route('dang_ky_sach.view_all') }}'" style="margin-left: 5px">
								<input type="button" class="btn btn-success btn-fill btn-sm btn-round" value="Thêm mới" data-toggle="modal" data-target="#addModal" style="margin-left: 5px">
							</td>
						</tr>
						<tr>
							<td>
								<b>Tên sách</b>
							</td>
							<td>
								<select name="ma_sach" class="form-control" style="width: 18rem" id="search_sach" disabled>
									<option>--Tên sách--</option>
									@foreach ($array_sach as $sach)
										<option value="{{$sach->ma_sach}}"
											@if ($sach->ma_sach == $ma_sach)
												selected 
											@endif
										>
											{{$sach->ten_sach}} ({{date_format(date_create($dang_ky_sach->ngay_nhap_sach),'d/m/Y')}})
										</option>
									@endforeach
								</select>
							</td>
							<td>
								<b>Tình trạng</b>
							</td>
							<td>
								<select name="tinh_trang_nhan_sach" class="form-control" style="width: 17rem" id="search_tinh_trang">
									<option value="">--Chọn tình trạng--</option>
									<option value="1"
										@if(isset($tinh_trang_nhan_sach))
											selected 
										@endif
									>
										Đã nhận
									</option>
									<option value="0"
										@if(isset($tinh_trang_nhan_sach) && $tinh_trang_nhan_sach == 0)
											selected
										@endif
									>Chưa nhận</option>
								</select>
							</td>
							<td>
								@if (isset($ma_lop) && isset($ma_sach))
									<a style="margin-left: 5px; color: green; border: 1px green solid" class="btn btn-round btn-sm btn-outline" href="{{ route('dang_ky_sach.export',['ma_lop' => $ma_lop, 'ma_sach' => $ma_sach]) }}">
										Xuất file excel
									</a>
									<a class="btn btn-danger btn-round btn-sm btn-outline" href="{{ route('dang_ky_sach.export_pdf',['ma_lop' => $ma_lop, 'ma_sach' => $ma_sach]) }}" style="margin-left: 5px">
										Xuất file pdf
									</a>
								@endif
							</td>			
					</tr>
					</table>
				</form>
			</div>
			<div style="margin-top: 12px">
	        	@if (Session::has('error'))
	        		<div class="alert alert-danger alert-block">
						{{Session::get('error')}}
						<button type="button" aria-hidden="true" class="close" data-dismiss="alert">
	                        <i class="pe-7s-close"></i>
	                    </button>
			   		</div>
				@endif
				@if (Session::has('error_1'))
	        		<div class="alert alert-danger alert-block">
						{{Session::get('error_1')}}
						<button type="button" aria-hidden="true" class="close" data-dismiss="alert">
	                        <i class="pe-7s-close"></i>
	                    </button>
			   		</div>
				@endif
				@if (Session::has('success'))
					<div class="alert alert-success alert-block">
						{{Session::get('success')}}
						<button type="button" aria-hidden="true" class="close" data-dismiss="alert">
	                        <i class="pe-7s-close"></i>
	                    </button>
			   		</div>
			    @endif
	        </div>
			@if (count($array_dang_ky_sach) > 0)
				<table class="table table-striped table-no-bordered table-hover dataTable dtr-inline">
				<thead>
					<tr>
						<th>Tên sinh viên</th>
						<th>Lớp</th>
						<th>Tình trạng</th>
						<th>Tên sách</th>
						<th>Ngày đăng ký</th>
						<th>Ngày nhận sách</th>		
					</tr>
				</thead>
				<tbody>
					@foreach ($array_dang_ky_sach as $dang_ky_sach)
						<tr>
							<td>{{$dang_ky_sach->ten_sinh_vien}}</td>
							<td>{{$dang_ky_sach->ten_lop}}</td>
							<td>
								{!!Helper::getRadioTinhTrang($dang_ky_sach->tinh_trang_nhan_sach,$dang_ky_sach->ma_dang_ky)!!}
							</td>
							<td>{{$dang_ky_sach->ten_sach}} ({{date_format(date_create($dang_ky_sach->ngay_nhap_sach),'d/m/Y')}})</td>
							<td>
								{{date_format(date_create($dang_ky_sach->ngay_dang_ky),'d/m/Y')}}
							</td>
							<td id="ngay_nhan_sach_{{$dang_ky_sach->ma_dang_ky}}">
								@if($dang_ky_sach->tinh_trang_nhan_sach == 1)

								{{date_format(date_create($dang_ky_sach->toArray()['ngay_nhan_sach']),'d/m/Y')}}
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>				
				<tfoot>
					<tr>
						<td colspan="100%">
							 {!! $array_dang_ky_sach->render()!!}
						</td>
					</tr>
				</tfoot>
			</table>
			@else
				<h4><center>{{ $message}}</center></h4>
			@endif	
		</div>

		<div class="modal fade" id="addModal" role="dialog">
	    	<div class="modal-dialog">
	    
	      <!-- Modal content-->
		      	<div class="modal-content">
			        <div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal">&times;</button>
			          	<h4 class="modal-title">Đăng ký</h4>
			        </div>
			        <div class="modal-body">
				        <form action="{{ route('dang_ky_sach.process_insert') }}" method="post">
				        	{{csrf_field()}}        
	                        <div class="row">
	                            <label class="col-sm-3" style="font-size: 1.75rem; font-weight: lighter">Chuyên ngành</label>
	                            <div class="col-sm-8">
	                                <div class="form-group">
	                                    <select name="ma_chuyen_nganh" class="form-control" style="width: 40rem" id="select_chuyen_nganh">
											<option disabled selected>--Chọn chuyên ngành--</option>
											@foreach ($array_chuyen_nganh as $chuyen_nganh)
												<option value="{{$chuyen_nganh->ma_chuyen_nganh}}">
													{{$chuyen_nganh->ten_chuyen_nganh}}
												</option>
											@endforeach
										</select>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <label class="col-sm-3" style="font-size: 1.75rem; font-weight: lighter">Tên lớp</label>
	                            <div class="col-sm-8">
	                                <div class="form-group">
	                                    <select name="ma_lop" class="form-control" style="width: 40rem" id="select_lop">
	                                    	<option disabled selected>--Chọn lớp--</option>
										</select>
	                                </div>
	                            </div>
	                        </div>		
	                        <div class="row">
	                            <label class="col-sm-3" style="font-size: 1.75rem; font-weight: lighter">Tên sinh viên</label>
	                            <div class="col-sm-8">
	                                <div class="form-group">
	                                    <select name="ma_sinh_vien" class="form-control" style="width: 40rem" id="select_sinh_vien" disabled>
	                                    	<option disabled selected>--Chọn sinh viên--</option>
										</select>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <label class="col-sm-3" style="font-size: 1.75rem; font-weight: lighter">Tên sách</label>
	                            <div class="col-sm-8">
	                                <div class="form-group">
	                                    <select name="ma_sach" class="form-control" style="width: 40rem" id="select_sach" disabled>
	                                    	<option disabled selected>--Chọn sách--</option>
										</select>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <label class="col-sm-3" style="font-size: 1.75rem; font-weight: lighter">Tình trạng</label>
	                            <div class="col-sm-8">
	                                <div class="form-group">
	                                    <select name="tinh_trang_nhan_sach" class="form-control" style="width: 40rem" id="select_tinh_trang" disabled>
												<option disabled selected>--Tình trạng--</option>
												<option value="1">Đã nhận</option>
												<option value="0">Chưa nhận</option>
										</select>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="modal-footer">
					        	<input type="submit" value="Thêm" id="button" class="add_button btn btn-fill btn-info btn-sm btn-round" disabled>
					          	<button type="button" class="btn btn-fill btn-default btn-sm btn-round" data-dismiss="modal">Close</button>
					        </div>					        	
				        </form>
			        </div>     
		      	</div>
	    	</div>
	  	</div>
	</div>
@endsection
@push('js')
<script src="{{ asset('js/select2.min.js') }}">
</script>
<script type="text/javascript">
	function checkButton() {
		if($("#select_tinh_trang").val() == 1 || $("#select_tinh_trang").val() == 0){
			$(".add_button").attr("disabled", false);
		}
		else{
			$(".add_button").attr("disabled", true);
		}
	}
	$(document).ready(function() {
		$("#select_tinh_trang").select2();
		$("#select_chuyen_nganh").select2();
		$("#select_chuyen_nganh").change(function(){
			$("#select_lop").attr("disabled", false);
			$("#select_sinh_vien").attr("disabled", true);
			$("#select_sach").attr("disabled", true);
			$("#select_tinh_trang").attr("disabled", true);
			$(".add_button").attr("disabled", true);
		})

		$("#select_lop").change(function(){
			$("#select_sinh_vien").attr("disabled", false);
			$("#select_sach").attr("disabled", true);
			$("#select_tinh_trang").attr("disabled", true);
			$(".add_button").attr("disabled", true);
		})

		$("#select_sinh_vien").change(function(){
			$("#select_sach").attr("disabled", false);
			$("#select_tinh_trang").attr("disabled", true);
			$(".add_button").attr("disabled", true);
		})

		$("#select_sach").change(function(){
			$("#select_tinh_trang").attr("disabled", false);
			$(".add_button").attr("disabled", true);
		})
		
		$("#select_lop").attr("disabled", true);

		$("#select_tinh_trang").change(function(){
			$(".add_button").attr("disabled", false);
		})
		$("#select_sach").change(function(){
			checkButton();
		})
		$("#select_sinh_vien").change(function(){
			checkButton();
		})

		$("#select_lop").select2({
			ajax: {
				url: '{{route('get_lop_by_chuyen_nganh')}}',
				dataType: 'json',
				data: function() {
					ma_chuyen_nganh = $("#select_chuyen_nganh").val();
					return {
						ma_chuyen_nganh: ma_chuyen_nganh
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

		$("#select_sach").select2({
			ajax: {
				url: '{{route('get_sach_by_chuyen_nganh')}}',
				dataType: 'json',
				data: function() {
					ma_chuyen_nganh = $("#select_chuyen_nganh").val();
					return {
						ma_chuyen_nganh: ma_chuyen_nganh
					}
				},
				processResults: function (data){
					return {
						results: $.map(data, function(item) {
							return  {
								text: `${item.ten_sach} (${formatDate(item.ngay_nhap_sach)})`,
								id: item.ma_sach
							}
						})
					};
				}
			}
		});
		
		$(".radio_tinh_trang").change(function(){
			var ma_dang_ky = $(this).data('ma_dang_ky');
			var tinh_trang_nhan_sach = $(this).data('tinh_trang_nhan_sach');
			$.ajax({
				url: '{{ route('dang_ky_sach.change_tinh_trang_dang_ky_sach') }}',
				dataType: 'html',
				data: {
					tinh_trang_nhan_sach: tinh_trang_nhan_sach,
					ma_dang_ky: ma_dang_ky
				},
			})
			.done(function() {
				switch(tinh_trang_nhan_sach){
					case 0:
						$("#ngay_nhan_sach_"+ma_dang_ky).html('');
						break;
					case 1:
						var d = new Date();
						var date = `${d.getDate()}/${d.getMonth()+1}/${d.getFullYear()}`;
						$("#ngay_nhan_sach_"+ma_dang_ky).html(date);
						break;
				}
			});
			
		});
		$("#select_sinh_vien").select2({
			ajax: {
				url: '{{route('get_sinh_vien_by_lop')}}',
				dataType: 'json',
				data: function() {
					ma_lop = $("#select_lop").val();
					return {
						ma_lop: ma_lop
					}
				},
				processResults: function (data){
					return {
						results: $.map(data, function(item) {
							return  {
								text: item.ten_sinh_vien,
								id: item.ma_sinh_vien
							}
						})
					};
				}
			}
		});

		//Search
		$("#search_lop").select2();
		$("#search_tinh_trang").select2();
		$("#search_lop").change(function(){
			$("#search_sinh_vien").val(null).trigger('change');
			$("#search_sinh_vien").attr("disabled", false);
			$("#search_sach").val(null).trigger('change');
			$("#search_sach").attr("disabled", false);
		})
		$("#search_lop").change(function(){
			$("#button").attr("disabled", false);
		})

		$("#search_tinh_trang").change(function(){
			$("#button").attr("disabled", false);
		})
	

		$("#search_sinh_vien").select2({
			ajax: {
				url: '{{route('get_sinh_vien_by_lop')}}',
				dataType: 'json',
				data: function() {
					ma_lop = $("#search_lop").val();
					return {
						ma_lop: ma_lop
					}
				},
				processResults: function (data){
					return {
						results: $.map(data, function(item) {
							return  {
								text: item.ten_sinh_vien,
								id: item.ma_sinh_vien 
							}
						})
					};
				}
			}
		});

		$("#search_sach").select2({
			ajax: {
				url: '{{route('get_sach_by_lop')}}',
				dataType: 'json',
				data: function() {
					ma_lop = $("#search_lop").val();
					return {
						ma_lop: ma_lop
					}
				},
				processResults: function (data){
					return {
						results: $.map(data, function(item) {
							return  {
								text: `${item.ten_sach} (${formatDate(item.ngay_nhap_sach)})`,
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