@extends('layer.master')
@section('pageTitle', 'Quản lý đăng ký sách')
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
	<div class="card">
		<h2 style="padding: 1%">Danh sách đăng ký</h2>
		<div class="content">
			<div class="toolbar">
				<form>
					<table style="width: 100%">
						<tr style="height: 4rem">
							<td>
								<b>Tên khóa học</b>
							</td>
							<td>
								<select name="ma_khoa_hoc" class="form-control" style="width: 14rem" id="search_khoa_hoc">
									<option disabled selected value="">--Chọn khóa học--</option>
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
							</td>
							<td>
								<b>Tên lớp</b>
							</td>
							<td>
								<select name="ma_lop" class="form-control" style="width: 14rem" id="search_lop" disabled>
									<option>--Lớp--</option>
								</select>
							</td>
							<td>
								<input type="submit" class="btn btn-round btn-sm btn-fill" value="Xem" id="button" disabled>
								<input type="button" class="btn btn-success btn-fill btn-sm btn-round" value="Thêm mới" data-toggle="modal" data-target="#addModal" style="margin-left: 5px">
								<input type="button" class="btn btn-info btn-round btn-sm btn-fill" value="Hiện tất cả" onclick="location.href='{{ route('dang_ky_sach.view_all') }}'" style="margin-left: 5px">
							</td>
						</tr>
						<tr>
							<td>
								<b>Tên sinh viên</b>
							</td>
							<td>
								<select name="ma_sinh_vien" class="form-control" style="width: 14rem" id="search_sinh_vien" disabled>
									<option>--Sinh viên--</option>
								</select>
							</td>
							<td>
								<b>Tên sách</b>
							</td>
							<td>
								<select name="ma_sach" class="form-control" style="width: 14rem" id="search_sach" disabled>
									<option>--Tên sách--</option>
								</select>
							</td>			
					</tr>
					</table>
				</form>
			</div>
			<div>
				@if (Session::has('error'))
                    <span style="color: red">
                        {{Session::get('error')}}
                    </span>
                @endif
                @if (Session::has('error_1'))
                    <span style="color: red">
                        {{Session::get('error_1')}}
                    </span>
                @endif
                @if (Session::has('success'))
                    <span style="color: green">
                        {{Session::get('success')}}
                    </span>
                @endif
			</div>
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
									{{date_format(date_create($dang_ky_sach->ngay_nhan_sach),'d/m/Y')}}
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
	                            <label class="col-sm-3" style="font-size: 1.75rem; font-weight:lighter">Khóa học</label>
	                            <div class="col-sm-8">
	                                <div class="form-group">
	                                    <select name="ma_khoa_hoc" class="form-control" style="width: 40rem" id="select_khoa_hoc" >
											<option disabled selected>--Chọn khóa học--</option>
											@foreach ($array_khoa_hoc as $khoa_hoc)
												<option value="{{$khoa_hoc->ma_khoa_hoc}}">
													{{$khoa_hoc->ten_khoa_hoc}}
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
	                                    <select name="ma_lop" class="form-control" style="width: 40rem" id="select_lop" disabled></select>
	                                </div>
	                            </div>
	                        </div>	
	                        <div class="row">
	                            <label class="col-sm-3" style="font-size: 1.75rem; font-weight: lighter">Tên môn</label>
	                            <div class="col-sm-8">
	                                <div class="form-group">
	                                    <select name="ma_mon_hoc" class="form-control" style="width: 40rem" id="select_mon_hoc" disabled></select>
	                                </div>
	                            </div>
	                        </div>	
	                        <div class="row">
	                            <label class="col-sm-3" style="font-size: 1.75rem; font-weight: lighter">Tên sinh viên</label>
	                            <div class="col-sm-8">
	                                <div class="form-group">
	                                    <select name="ma_sinh_vien" class="form-control" style="width: 40rem" id="select_sinh_vien" disabled>
											</select>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <label class="col-sm-3" style="font-size: 1.75rem; font-weight: lighter">Tên sách</label>
	                            <div class="col-sm-8">
	                                <div class="form-group">
	                                    <select name="ma_sach" class="form-control" style="width: 40rem" id="select_sach" disabled>
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

@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script type="text/javascript">
	function checkTinhTrang() {
		if($("#select_sach").val()==null || $("#select_sinh_vien").val()==null){
			$("#select_tinh_trang").attr('disabled',true);
		}
		else{
			$("#select_tinh_trang").attr('disabled',false);
		}
	}
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
		$("#select_khoa_hoc").select2();

		$("#select_khoa_hoc").change(function(){
			$("#select_mon_hoc").val(null).trigger('change');
			$("#select_mon_hoc").attr("disabled", false);
			$("#select_lop").val(null).trigger('change');
			$("#select_lop").attr("disabled", false);
			$("#select_sach").attr("disabled", true);
			$("#select_sinh_vien").attr("disabled", true);
		})
		$("#select_mon_hoc").change(function(){
			$("#select_sach").val(null).trigger('change');
			$("#select_sach").attr("disabled", false);
			$(".add_button").attr("disabled", true);
		})
		$("#select_lop").change(function(){
			$("#select_sinh_vien").val(null).trigger('change');
			$("#select_sinh_vien").attr("disabled", false);
			$(".add_button").attr("disabled", true);
		})
		$("#select_sach,#select_sinh_vien").change(function(){
			checkTinhTrang();
		});
		$("#select_tinh_trang").change(function(){
			$(".add_button").attr("disabled", false);
		})
		$("#select_sach").change(function(){
			checkButton();
		})
		$("#select_sinh_vien").change(function(){
			checkButton();
		})

		$("#select_mon_hoc").select2({
			ajax: {
				url: '{{route('get_mon_hoc_by_khoa_hoc')}}',
				dataType: 'json',
				data: function() {
					ma_khoa_hoc = $("#select_khoa_hoc").val();
					return {
						ma_khoa_hoc: ma_khoa_hoc
					}
				},
				processResults: function (data){
					return {
						results: $.map(data, function(item) {
							return  {
								text: item.ten_mon_hoc,
								id: item.ma_mon_hoc 
							}
						})
					};
				}
			}
		});
		$("#select_lop").select2({
			ajax: {
				url: '{{route('get_lop_by_khoa_hoc')}}',
				dataType: 'json',
				data: function() {
					ma_khoa_hoc = $("#select_khoa_hoc").val();
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
		$("#select_sach").select2({
			ajax: {
				url: '{{route('get_sach_by_mon_hoc_1')}}',
				dataType: 'json',
				data: function() {
					ma_mon_hoc = $("#select_mon_hoc").val();
					return {
						ma_mon_hoc: ma_mon_hoc
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
		$("#search_khoa_hoc").select2();
		$("#search_khoa_hoc").change(function(){
			$("#search_mon_hoc").val(null).trigger('change');
			$("#search_mon_hoc").attr("disabled", false);		
			$("#search_lop").val(null).trigger('change');		
			$("#search_lop").attr("disabled", false);
			$("#search_sach").attr("disabled", true);
			$("#search_sinh_vien").attr("disabled", true);
		})
		$("#search_lop").change(function(){
			$("#search_sinh_vien").val(null).trigger('change');
			$("#search_sinh_vien").attr("disabled", false);
			$("#search_sach").val(null).trigger('change');
			$("#search_sach").attr("disabled", false);
		})
		$("#search_khoa_hoc").change(function(){
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