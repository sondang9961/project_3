@extends('layer.master')
@section('content')
	<div class="main-content">
        <div class="container-fluid">
            <div class="row">
				<div class="col-md-8">
			        <div class="card">
			            <div class="header">
			                <h4 class="title">Thông tin cá nhân</h4>
			            </div>
			            <div class="content">
			                <form method="post" action="{{route('process_update_profile',['ma_giao_vu' => Session::get('ma_giao_vu')])}}">
			                	{{csrf_field()}}
		                            <div class="form-group">
		                                <label>Công ty</label>
		                                <input type="text" class="form-control" disabled placeholder="Company" value="Bkacad">
		                            </div>
		                            <div class="form-group">
		                                <label>Tên hiển thị</label>
		                                <input type="text" name="ten_giao_vu" class="form-control" placeholder="Username" value="{{$array_giao_vu[0]->ten_giao_vu}}">
		                            </div>
		                            <div class="form-group">
		                                <label for="exampleInputEmail1">Email</label>
		                                <input type="email" name="email" class="form-control" value="{{$array_giao_vu[0]->email}}">
		                            </div>
		                            <div class="form-group">
		                                <label for="exampleInputEmail1">Số điện thoại</label>
		                                <input type="text" name="sdt" class="form-control" value="{{$array_giao_vu[0]->sdt}}">
		                            </div>
		                            <div class="form-group">
		                                <label>Địa chỉ</label>
		                                <input type="text" name="dia_chi" class="form-control" placeholder="Home Address" value="{{$array_giao_vu[0]->dia_chi}}">
		                            </div>
			                    <button type="submit" class="btn btn-info btn-fill center-block">Cập nhật</button>
			                    <div class="clearfix"></div>
			                </form>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>

@endsection