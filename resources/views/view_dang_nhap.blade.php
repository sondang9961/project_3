<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đăng nhập</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" />
</head>
<body style="background: url(../public/img/background_1.jpg)">
	<div id="main">
		<form id="frm_login" action="trang_chu" method="post">
			{!! csrf_field() !!}
			<div class="content">
				<h1>Đăng nhập</h1>
			</div>
			<div class="content">
				<b>Tên đăng nhập</b>
			</div>
			<div class="content">
				<input type="text" name="ten_dang_nhap" class="textbox">
			</div>
			<div class="content">
				<b>Mật khẩu</b>
			</div>
			<div class="content">
				<input type="password" name="mat_khau" class="textbox">
			</div>
			<div align="center">
				<input type="submit" value="Đăng nhập" id="login_button">
			</div><br>
			<div align="center"><a href="#" style="text-decoration:none">Quên mật khẩu?</a></div>
		</form>
	</div>
</body>
</html>