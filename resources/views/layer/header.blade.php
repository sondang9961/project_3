<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-minimize">
			<button id="minimizeSidebar" class="btn btn-fill btn-round btn-icon">
				<i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
				<i class="fa fa-navicon visible-on-sidebar-mini"></i>
			</button>
		</div>
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ route('trang_chu') }}">PROJECT 2</a>
		</div>
		<div class="collapse navbar-collapse">


			<ul class="nav navbar-nav navbar-right">
				

				<li class="dropdown">
					
					<ul class="dropdown-menu">
						<li><a href="#">Create New Post</a></li>
						<li><a href="#">Manage Something</a></li>
						<li><a href="#">Do Nothing</a></li>
						<li><a href="#">Submit to live</a></li>
						<li class="divider"></li>
						<li><a href="#">Another Action</a></li>
					</ul>
				</li>


				<li class="dropdown dropdown-with-icons">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-list"></i>
						<p class="hidden-md hidden-lg">
							More
							<b class="caret"></b>
						</p>
					</a>
					<ul class="dropdown-menu dropdown-with-icons">
						<li>
							<a href="{{route('profile',['ma_giao_vu' => Session::get('ma_giao_vu')])}}">
								<i class="pe-7s-user"></i>Thông tin cá nhân
							</a>
						</li>
						<li>
							<a href="{{route('view_doi_mat_khau',['ma_giao_vu' => Session::get('ma_giao_vu')])}}">
								<i class="pe-7s-config"></i>Đổi mật khẩu
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="{{ route('logout')}}" class="text-danger">
								<i class="pe-7s-close-circle"></i>
								Log out
							</a>
						</li>
					</ul>
				</li>

			</ul>
		</div>
	</div>
</nav>