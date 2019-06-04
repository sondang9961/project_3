<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đăng nhập</title>
<style type="text/css">
	.textbox {border-radius: 6px;height: 25px; width: 93%; box-shadow:none; margin-bottom: 15px}
	#button {border-radius: 30px; width: 30%; height: 30px; font-weight: bold; background-color: #484646; box-shadow: none;color:white}
	#main {border-radius: 8px;background-color: #ffffff; height:300px ; width: 28%; margin-left: 36%; margin-top: 9%}
	.content {margin-left: 20px; font-size: 18px}
</style>
</head>
<body style="background: url(../Images/background_1.jpg)">
		<div id="main">
			<form id="frm_login" action="view_trang_chu.php">
				<div class="content">
					<h1>Đăng nhập</h1>
				</div>
				<div class="content">
					<b style="color: grey">Tên đăng nhập</b>
				</div>
				<div class="content">
					<input type="text" name="ten_dang_nhap" class="textbox">
				</div>
				<div class="content">
					<b style="color: grey">Mật khẩu</b>
				</div>
				<div class="content">
					<input type="password" name="mat_khau" class="textbox">
				</div>
				<div align="center">
					<input type="submit"  value="Đăng nhập" id="button">
				</div><br>
				<div align="center"><a href="#" style="text-decoration:none">Quên mật khẩu?</a></div>
			</form>
		</div>
	</div>
</body>
</html>