@extends('layer.master')
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<center><h1 id="header">Quản lý đăng ký sách</h1></center>
	<div id="main_content">
		<div id="left_content">
			<div><h2>Danh sách sinh viên đăng ký sách</h2></div>
			<form>
				<table style="width: 100%">
					<tr style="height: 4rem">
						<td>
							Tên khóa học
						</td>
						<td>
							<select name="ma_khoa_hoc" class="form-control" style="width: 14rem" id="search_khoa_hoc">
								<option disabled selected value="">--Chọn khóa học--</option>
								@foreach ($array_khoa_hoc as $khoa_hoc)
									<option value="{{$khoa_hoc->ma_khoa_hoc}}"
									{{-- 	@if ($khoa_hoc->ma_khoa_hoc == $ma_khoa_hoc)
											selected 
										@endif --}}
										>
										{{$khoa_hoc->ten_khoa_hoc}}
									</option>
								@endforeach
							</select>
						</td>
						<td>
							Tên lớp
						</td>
						<td>
							<select name="ma_lop" class="form-control" style="width: 14rem" id="search_lop" disabled>
								<option>--Lớp--</option>
							</select>
						</td>
						<td>
							<input type="submit" value="Xem" id="button" disabled>
						</td>
					</tr>
					<tr>
						<td>
							Tên môn
						</td>
						<td>
							<select name="ma_mon_hoc" class="form-control" style="width: 14rem" id="search_mon_hoc" disabled>
								<option>--Môn học--</option>
							</select>
						</td>
						<td>
							Tên sách
						</td>
						<td>
							<select name="ma_sach" class="form-control" style="width: 14rem" id="search_sach" disabled>
								<option>--Tên sách--</option>
							</select>
						</td>
						<td>
							<a href="{{ route('dang_ky_sach.view_all') }}">
								<input type="button" value="Tất cả" id="button">
							</a>
						</td>
				</tr>
				</table>
			</form>
			 <br/>
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
						@isset ($dang_ky_sach->ngay_nhan_sach)
						    {{date_format(date_create($dang_ky_sach->ngay_nhan_sach),'d/m/Y')}}
						@endisset
					</td>
				</tr>
				@endforeach
				<tfoot>
					<tr>
						<td colspan="100%">
							Trang:
							@if ($trang > 1)
								<a href="{{ route('dang_ky_sach.view_all',[
										'trang' => 1,
										'ma_khoa_hoc' => $ma_khoa_hoc,
										'ma_lop' => $ma_lop,
										'ma_mon_hoc' => $ma_mon_hoc,
										'ma_sach' => $ma_sach,
									]) }}" style="font-weight:bold " 				
								>
									Đầu
								</a>
								<a href="{{ route('dang_ky_sach.view_all',[
										'trang' => $prev, 
										'ma_khoa_hoc' => $ma_khoa_hoc,
										'ma_lop' => $ma_lop,
										'ma_mon_hoc' => $ma_mon_hoc,
										'ma_sach' => $ma_sach,
									]) }}" style="font-weight:bold " >
									<<
								</a>
							@endif
							@if ($count_trang > 7)
								@for ($i = $startpage; $i <= $endpage; $i++)
									<a href="{{ route('dang_ky_sach.view_all',[
											'trang' => $i,
											'ma_khoa_hoc' => $ma_khoa_hoc,
											'ma_lop' => $ma_lop,
											'ma_mon_hoc' => $ma_mon_hoc,
											'ma_sach' => $ma_sach,
										]) }}" 
										@if ($trang==$i)
											style='font-weight: bolder; font-size: 17px'
										@endif
									>
										{{$i}}
									</a>
								@endfor
							@else
								@for ($i = 1; $i <= $count_trang; $i++)
									<a href="{{ route('dang_ky_sach.view_all',[
											'trang' => $i,
											'ma_khoa_hoc' => $ma_khoa_hoc,
											'ma_lop' => $ma_lop,
											'ma_mon_hoc' => $ma_mon_hoc,
											'ma_sach' => $ma_sach,
										]) }}"
										@if ($trang==$i)
											style='font-weight: bolder; font-size: 17px'
										@endif
										>
										{{$i}}
									</a>
								@endfor
							@endif
							@if ($trang < $count_trang)
								<a href="{{ route('dang_ky_sach.view_all',[
										'trang' => $next, 
										'ma_khoa_hoc' => $ma_khoa_hoc,
										'ma_lop' => $ma_lop,
										'ma_mon_hoc' => $ma_mon_hoc,
										'ma_sach' => $ma_sach,
										]) }}" style="font-weight:bold " >
									>>
								</a>
								<a href="{{ route('dang_ky_sach.view_all',[
										'trang' => $count_trang, 
										'ma_khoa_hoc' => $ma_khoa_hoc,
										'ma_lop' => $ma_lop,
										'ma_mon_hoc' => $ma_mon_hoc,
										'ma_sach' => $ma_sach,
										]) }}" style="font-weight:bold " >
									Cuối
								</a>
							@endif
							
						</td>
					</tr>
				</tfoot>
			</table>		
		</div>
		<div id="right_content" >
			<div><h2>Đăng ký sách</h2></div>
				<div>
					<form action="{{ route('dang_ky_sach.process_insert') }}" method="post">
						{{csrf_field()}}
						<table width="90%">
							<tr style="height: 4rem">
								<div>
									<td>
										<div>Khóa học</div>
										<div>
											<select name="ma_khoa_hoc" class="form-control" style="width: 14rem" id="select_khoa_hoc" >
												<option disabled selected>--Chọn khóa học--</option>
												@foreach ($array_khoa_hoc as $khoa_hoc)
													<option value="{{$khoa_hoc->ma_khoa_hoc}}">
														{{$khoa_hoc->ten_khoa_hoc}}
													</option>
												@endforeach
											</select>
										</div>
									</td>
								</div>
								<div id="div_lop">
									<td>
										<div>Tên lớp</div>
										<div>
											<select name="ma_lop" class="form-control" style="width: 14rem" id="select_lop" disabled>
											</select>
										</div>
									</td>
								</div>							
							</tr>
							<tr style="height: 7rem">
								<div id="div_mon_hoc">
									<td>
										<div>Tên môn</div>
										<div>
											<select name="ma_mon_hoc" class="form-control" style="width: 14rem" id="select_mon_hoc" disabled>
											</select>
										</div>
									</td>
								</div>
								<div id="div_sinh_vien">
									<td>
										<div>Tên sinh viên</div>
										<div>
											<select name="ma_sinh_vien" class="form-control" style="width: 14rem" id="select_sinh_vien" disabled>
											</select>
										</div>
									</td>
								</div>										
							</tr>
							<tr>
								<div id="div_sach">
									<td>
										<div>Tên sách</div>	
										<div>
											<select name="ma_sach" class="form-control" style="width: 14rem" id="select_sach" disabled>
											</select>
										</div>
									</td>
								</div>
								<div>
									<td>
										<div>Tình trạng</div>	
										<div>
											<select name="tinh_trang_nhan_sach" class="form-control" style="width: 14rem" id="select_tinh_trang" disabled>
												<option disabled selected>--Tình trạng--</option>
												<option value="1">Đã nhận</option>
												<option value="0">Chưa nhận</option>
											</select>
										</div>
									</td>
								</div>										
							</tr>
							<tr>
								<td>
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
								</td>
							</tr>
						</table><br><br>
						<div><input type="submit" value="Thêm" id="button" class="add_button" disabled></div>
					</form>
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
		})
		$("#search_mon_hoc").change(function(){
			$("#search_sach").val(null).trigger('change');
			$("#search_sach").attr("disabled", false);
		})
		$("#search_lop").change(function(){
			$("#search_sinh_vien").val(null).trigger('change');
		})
		$("#search_khoa_hoc").change(function(){
			$("#button").attr("disabled", false);
		})
	

		$("#search_mon_hoc").select2({
			ajax: {
				url: '{{route('get_mon_hoc_by_khoa_hoc')}}',
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
								text: item.ten_mon_hoc,
								id: item.ma_mon_hoc 
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
				url: '{{route('get_sach_by_mon_hoc')}}',
				dataType: 'json',
				data: function() {
					ma_mon_hoc = $("#search_mon_hoc").val();
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


	});
</script>
@endpush