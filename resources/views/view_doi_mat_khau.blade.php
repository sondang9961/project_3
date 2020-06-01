@extends('layer.master')
@section('pageTitle', 'Đổi mật khẩu')
@section('content')
	<div class="main-content">
        <div class="container-fluid">
            <div class="row">
				<div class="col-md-6">
			        <div class="card">
			            <div class="header">
			                <h4 class="title">Đổi mật khẩu</h4>
			            </div>
			            <div class="content">
			                <form method="post" action="{{route('process_update_mat_khau')}}" id="form">
			                	{{csrf_field()}}
			                	<input type="hidden" name="ma_giao_vu" value="{{Session::get('ma_giao_vu')}}">
	                        	<div class="form-group">
	                                <label>Mật khẩu cũ</label>
	                                <input type="password" name="old_password" class="form-control">
	                                @if(Session::has('error'))
										<span style="color: red">
			                                {{Session::get('error')}}
			                            </span>
									@endif
									<span id=""></span>
	                            </div>	
	                            <div class="form-group">
	                                <label>Mật khẩu mới</label>
	                                <input type="password" name="new_password" class="form-control" id="new_password">
	                                <span id="errPass" style="color: red"></span>
	                            </div>
			                    <div>
			                    	@if (Session::has('success'))
			                            <span style="color: green">
			                                {{Session::get('success')}}
			                            </span>
			                        @endif
			                    </div>
			                    <button type="button" class="btn btn-info btn-fill center-block" onclick="validate()">Cập nhật</button>
			                    <div class="clearfix"></div>
			                </form>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>

@endsection
@push('js')
<script type="text/javascript">
	function validate(){
		var new_password = document.getElementById('new_password').value;
		var errPass = document.getElementById('errPass');

		if(new_password.length == 0){
			errPass.innerHTML="Chưa nhập mật khẩu mới";
		}
		else{
			document.getElementById('form').submit();
		}
	}
</script>
@endpush