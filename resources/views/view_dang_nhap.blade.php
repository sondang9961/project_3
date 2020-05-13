<!doctype html>
<html lang="en">
<head>
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

</head>
<body style=" background-image: url('{{asset('img/full-screen-image-3.jpg')}}'); background-repeat: no-repeat; background-size: 100% 100%;">
<div class="wrapper wrapper-full-page">
    <div class="full-page login-page" data-color="black">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                        <form method="post" action="{{ route('process_login')}}" id="form">
                        {{csrf_field()}}
                        <!--   if you want to have the card without animation please remove the ".card-hidden" class   -->
                            <div class="card">
                                <div class="header text-center">Login</div>
                                <div class="content">
                                    @if (Session::has('error'))
                                        <span style="color: red">
                                            {{Session::get('error')}}
                                        </span>
                                    @endif
                                    @if (Session::has('success'))
                                        <span style="color: green">
                                            {{Session::get('success')}}
                                        </span>
                                    @endif
                                    <div class="form-group">
                                        <label>USERNAME</label> <span id="errUser" style="color: red"></span>
                                        <input type="username" name="username" id="username" placeholder="Enter username" class="form-control">
                                    </div>
                                   
                                    <div class="form-group">
                                        <label>PASSWORD</label>  <span id="errPass" style="color: red"></span>
                                        <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                                    </div>
                                </div>
                                <div class="footer text-center">
                                    <input type="button" value="Login" class="btn btn-fill btn-default btn-wd" onclick="validate()"/>
                                </div>    
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
@push('js')
    <!--   Core JS Files  -->
    <script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>


    <!-- Light Bootstrap Dashboard Core javascript and methods -->
	<script src="{{asset('js/light-bootstrap-dashboard.js')}}"></script>
@endpush
<script type="text/javascript">
    function validate() {
        var dem=0;
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var errUser = document.getElementById('errUser');
        var errPass = document.getElementById('errPass');

        if(username.length == 0 ){
            errUser.innerHTML="Chưa nhập username";
        }else{
            errUser.innerHTML="";
            dem++;
        }

        if(password.length == 0 ){
            errPass.innerHTML="Chưa nhập password";
        }else{
            errPass.innerHTML="";
            dem++;
        }
        if(dem == 2){
            document.getElementById('form').submit();
        }
    };
</script>
    

