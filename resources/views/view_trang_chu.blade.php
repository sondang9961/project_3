<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Quản lý đăng ký sách</title>
</head>
<link rel="stylesheet" type="text/css" href="../../public/css/style.css" />
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
					<a href="{{route('dang_ky_sach.view_all')}}" class="a2"><li class="li3">Quản lý đăng ký sách</li></a>
					<a href="{{route('khoa_hoc.view_all')}}" class="a2"><li class="li3">Quản lý khóa học</li></a>
					<a href="{{route('lop.view_all')}}" class="a2"><li class="li3">Quản lý lớp</li></a>
					<a href="{{route('sinh_vien.view_all')}}" class="a2"><li class="li3">Quản lý sinh viên</li></a>		
					<a href="{{route('mon_hoc.view_all')}}" class="a2"><li class="li3">Quản lý môn học</li></a>
					<a href="{{route('sach.view_all')}}" class="a2"><li class="li3">Quản lý sách</li></a>
					<a href="{{route('thong_ke.view_all')}}" class="a2"><li class="li3">Thống kê</li></a>
				</ul>			
			</div>
			<div id="right_content_trang_chu">
				@yield('content')
			</div>
		<div id="footer"></div>	
	</div>
</div>
</body>
</html>