@extends('layer.master')
@section('content')
<font face="Roboto,Helvetica Neue,Arial,sans-serif">
<center><h1 id="header">Quản lý khóa học</h1></center>
	<div id="main_content">
		<div id="left_content">
			<div><h2>Danh sách khóa học</h2></div>	
			<table class="table table-striped table-no-bordered table-hover dataTable dtr-inline">
				<thead>
					<tr>
						<th>Mã</th>
						<th>Tên khóa học</th>
						<th>Chức năng</th>
					</tr>
				</thead>	
				@foreach ($array_khoa_hoc as $khoa_hoc)
				<!--<form action="{{route('khoa_hoc.process_update', ['ma_khoa_hoc' => $khoa_hoc->ma_khoa_hoc])}}" method="post">-->
					{{csrf_field()}}
					<tr>
						<td>{{$khoa_hoc->ma_khoa_hoc}}</td>
						<td>
							{{$khoa_hoc->ten_khoa_hoc}}
						</td>
						<td>
							<input type="button" class='button_update' value="Cập nhật" data-toggle="modal" data-target="#myModal" data-ma_khoa_hoc='{{$khoa_hoc->ma_khoa_hoc}}'>
						</td>
					</tr>
				<!--</form>-->
				@endforeach
			</table>			
		</div>
		<div id="right_content" >
			<div><h2>Thêm khóa học</h2></div>
				<div>
					<form action="{{route('khoa_hoc.process_insert')}}" method="post" id="form_insert">
						{{csrf_field()}}
						<div>Tên khóa học</div>	
						<div>
							<input type="text" name="ten_khoa_hoc" id="ten_khoa_hoc">
							<span id="errKhoaHoc" style="color: red"></span>
						</div><br>
						<div><input type="button" value="Thêm" id="button" onclick="validate()"></div>
					</form>
				</div>
		</div>
	</div>

	<div class="modal fade" id="myModal" role="dialog">
    	<div class="modal-dialog">
    
      <!-- Modal content-->
	      	<div class="modal-content">
		        <div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		          	<h4 class="modal-title">Cập nhật khóa học</h4>
		        </div>
		        <div class="modal-body">
			        <form action="{{route('khoa_hoc.process_update', ['ma_khoa_hoc' => $khoa_hoc->ma_khoa_hoc])}}" method="post">
			        	{{csrf_field()}}
			          	<input type="hidden" name="ma_khoa_hoc" id="ma_khoa_hoc">
			          	Tên khóa học 	
			          	<input type="text" name="ten_khoa_hoc" id="ten_khoa_hoc">
			        	<input type="submit" value="Sửa">
			        </form>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        </div>
	      	</div>
    	</div>
  	</div>
</font>
@endsection
@push('js')
  	<script type="text/javascript">
  		$(document).ready(function() {
  			$(".button_update").click(function(event) {
  				var ma_khoa_hoc = $(this).data('ma_khoa_hoc');
  				$.ajax({
  					url: '{{ route('khoa_hoc.get_one') }}',
  					dataType: 'json',
  					data: {
  						ma_khoa_hoc: ma_khoa_hoc
  					},
  				})
  				.done(function(response) {
  					$("#ma_khoa_hoc").val(response.ma_khoa_hoc);
  					$("#ten_khoa_hoc").val(response.ten_khoa_hoc);
  				})
  				.fail(function() {
  					console.log("error");
  				});		
  			});
  		});
  		function validate() {
  			var dem = 0;
  			var ten_khoa_hoc = document.getElementById('ten_khoa_hoc').value;
  			var errKhoaHoc = document.getElementById('errKhoaHoc');

  			if(ten_khoa_hoc.length == 0){
  				errKhoaHoc.innerHTML="Không được trống!";
  			}else{
  				errKhoaHoc.innerHTML="";
  				dem++;
  			}
  			if(dem == 1){
  				document.getElementById('form_insert').submit();
  			}
  		}
  	</script>
@endpush