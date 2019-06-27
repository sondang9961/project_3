@extends('layer.master')
@section('content')
	<div class="main-content">
        <div class="container-fluid">
            <div class="row">
				<div class="col-md-8">
			        <div class="card">
			            <div class="header">
			                <h4 class="title">Đổi mật khẩu</h4>
			            </div>
			            <div class="content">
			                <form method="post" action="{{route('process_update_mat_khau',['ma_giao_vu' => Session::get('ma_giao_vu')])}}">
			                	{{csrf_field()}}
			                    <div class="row">
			                        <div class="col-md-5">
			                            <div class="form-group">
			                                <label>Mật khẩu mới</label>
			                                <input type="password" name="password" class="form-control">
			                            </div>
			                        </div>
			                    </div>
			                    <button type="submit" class="btn btn-info btn-fill pull-right">Cập nhật</button>
			                    <div class="clearfix"></div>
			                </form>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>

@endsection