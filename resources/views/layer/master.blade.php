<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="{{ asset('img/fav_icon.png') }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>@yield('pageTitle')</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />

	<!-- Bootstrap core CSS     -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
   
	<!--  Light Bootstrap Dashboard core CSS    -->
	<link href="{{asset('css/light-bootstrap-dashboard.css')}}" rel="stylesheet" />

	<!--     Fonts and icons     -->
	<link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/pe-icon-7-stroke.css') }}" rel="stylesheet" />
	
	@stack('css')
</head>
<body>

<div class="wrapper">
	<!-- Menu -->

	@include('layer.menu')

	<div class="main-panel">
		<!-- Header -->
		@include('layer.header')
		
		<div class="main-content">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
						<!-- content -->
						@yield('content')
					</div>
						

				</div>
			</div>
			@yield('trang_chu')
		</div>


		<!--footer-->
		<footer class="footer">
            <div class="container">
                <nav>
                    <p class="copyright text-center">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="https://www.bkacad.com/vn/index.php">BKACAD</a>, made with love
                    </p>
                </nav>
            </div>
        </footer>
	</div>
</div>


</body>
	<!--   Core JS Files  -->
	<script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>


	<!-- Light Bootstrap Dashboard Core javascript and methods -->
	<script src="{{asset('js/light-bootstrap-dashboard.js')}}"></script>
	@include('layer.script')
	@stack('js')
</html>