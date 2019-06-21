<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="../assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Project 2</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />

	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" />

	<!-- Bootstrap core CSS     -->
	<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />
   

	<!--  Light Bootstrap Dashboard core CSS    -->
	<link href="{{asset('css/light-bootstrap-dashboard.css')}}" rel="stylesheet" />


	<!--     Fonts and icons     -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
	
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
						<div class="col-md-6 col-md-offset-1">
							<div id="worldMap" style="height: 300px;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!--footer-->

	</div>
</div>


</body>
	<!--   Core JS Files  -->
	<script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>


	<!-- Light Bootstrap Dashboard Core javascript and methods -->
	<script src="{{asset('js/light-bootstrap-dashboard.js')}}"></script>

	@stack('js')
</html>