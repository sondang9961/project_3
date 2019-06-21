@extends('layer.master')
@push('css')
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Login</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />
   

    <!--  Light Bootstrap Dashboard core CSS    -->
    <link href="{{asset('css/light-bootstrap-dashboard.css')}}" rel="stylesheet" />



    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="css/pe-icon-7-stroke.css" rel="stylesheet" />
@endpush
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
			                    <div class="row">
			                        <div class="col-md-5">
			                            <div class="form-group">
			                                <label>Công ty</label>
			                                <input type="text" class="form-control" disabled placeholder="Company" value="Bkacad">
			                            </div>
			                        </div>
			                    </div>
			                    <div class="row">    
			                        <div class="col-md-3">
			                            <div class="form-group">
			                                <label>Tên hiển thị</label>
			                                <input type="text" name="ten_giao_vu" class="form-control" placeholder="Username" value="{{$array_giao_vu->ten_giao_vu}}">
			                            </div>
			                        </div>
			                    </div>
			                    <div class="row">
			                        <div class="col-md-4">
			                            <div class="form-group">
			                                <label for="exampleInputEmail1">Email</label>
			                                <input type="email" name="email" class="form-control" value="{{$array_giao_vu->email}}">
			                            </div>
			                        </div>			                    
								</div>
			                     <div class="row">
			                        <div class="col-md-4">
			                            <div class="form-group">
			                                <label for="exampleInputEmail1">Số điện thoại</label>
			                                <input type="text" name="sdt" class="form-control" value="{{$array_giao_vu->sdt}}">
			                            </div>
			                        </div>			                    
								</div>
			                    <div class="row">
			                        <div class="col-md-12">
			                            <div class="form-group">
			                                <label>Địa chỉ</label>
			                                <input type="text" name="dia_chi" class="form-control" placeholder="Home Address" value="{{$array_giao_vu->dia_chi}}">
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
@push('js')
  <!--   Core JS Files  -->
    <script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>


    <!-- Light Bootstrap Dashboard Core javascript and methods -->
	<script src="{{asset('js/light-bootstrap-dashboard.js')}}"></script>


@endpush