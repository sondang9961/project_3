<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<style type="text/css">
	body {margin: 0px}
	#menu { width:100% ; height: 615px; float: left;width: 15%; background-color: #1c2b36;cursor: pointer;}
	#li1:hover #ul2 {width: 116px; height: 60px; display: block; list-style: none;margin-top: 9%;margin-right:-20px; background-color: #464b50; position: relative; }
	li #ul2 {display: none}
	li:hover {color: #45b2e6}	
	#li1 {float: right;  margin-right:20px ; margin-top: -33px; }
	#ul1 {height: 15px; list-style: none; float: right  }
	.li2 {height: 26px; font-size: 17px; margin-left:-40px; padding-top: 5px; cursor: pointer;color: white;width: 101px; padding-left: 10px; }
	.li3 {color: #acd8d3; list-style: none;margin-left: -40px;height: 30px;padding-top: 10px;padding-left: 20px;}
	.li3:hover {background-color: #00897b; width: 112%; }
	#a1 {color: white; text-decoration: none;}
	.a2 {color: white; text-decoration: none}
	#header {color: white; background-color: #1c2b36; width: 100%; height: 30px;padding-top: 10px;border-bottom:2px black solid; }
	#right_content {background-color: #c1c1c1; float: left; width: 85%; height: 615px;margin-top: -33px;}
</style>
<body>
<font face="Arial, Helvetica, sans-serif">
	<div>
		<div id="header">
			Welcome,
				<div>
					<ul id="ul1">
						<li id="li1">
							<a href="" id="a1">Thông tin tài khoản</a>
							<ul id="ul2">
								<li class="li2">Đổi mật khẩu</li>
								<li class="li2">Đăng xuất</li>
							</ul>
						</li>
					</ul>
				</div>
		</div>
		<div id="content">
			<div id="menu">
				<ul>
					<li class="li3"><a href="quan_ly_lop" class="a2">Quản lý lớp</a></li>
					<li class="li3"><a href="quan_ly_mon_hoc" class="a2">Quản lý môn học</a></li>
					<li class="li3"><a href="quan_ly_khoa_hoc" class="a2">Quản lý khóa học</a></li>
					<li class="li3"><a href="quan_ly_sach" class="a2">Quản lý sách</a></li>
					<li class="li3"><a href="quan_ly_dang_ky_sach" class="a2">Quản lý đăng ký sách</a></li>
					<li class="li3"><a href="thong_ke" class="a2">Thống kê</a></li>
				</ul>			
			</div>
			<div id="right_content">
				
			</div>
		<div id="footer"></div>	
	</div>
</div>
</body>
</html>