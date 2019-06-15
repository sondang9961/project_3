<div class="sidebar" data-color="#565656" data-image="../assets/img/full-screen-image-3.jpg">
    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    <div class="logo">
        <img src="{{asset('img/logo_bkacad.png')}}" class="simple-text logo-mini" width="95%%">
    </div>

	<div class="sidebar-wrapper">
        <div class="user">
			<div class="info">	

				<a data-toggle="collapse" href="#collapseExample" class="collapsed">
					<span>
						Tania Andrew
                        <b class="caret"></b>
					</span>
                </a>

				<div class="collapse" id="collapseExample">
					<ul class="nav">
						<li>
							<a href="#pablo">
								<span class="sidebar-mini">MP</span>
								<span class="sidebar-normal">My Profile</span>
							</a>
						</li>

						<li>
							<a href="#pablo">
								<span class="sidebar-mini">EP</span>
								<span class="sidebar-normal">Edit Profile</span>
							</a>
						</li>

						<li>
							<a href="#pablo">
								<span class="sidebar-mini">S</span>
								<span class="sidebar-normal">Settings</span>
							</a>
						</li>
					</ul>
                </div>
			</div>
        </div>

		<ul class="nav">
			<li class="active">
				<a href="{{route('dang_ky_sach.view_all')}}">
					<i class="pe-7s-graph"></i>
					<p>Quản lý đăng ký sách</p>
				</a>
			</li>
			<li class="active">
				<a href="{{route('khoa_hoc.view_all')}}">
					<i class="pe-7s-graph"></i>
					<p>Quản lý khóa học</p>
				</a>
			</li>
			<li class="active">
				<a href="{{route('lop.view_all')}}">
					<i class="pe-7s-graph"></i>
					<p>Quản lý lớp</p>
				</a>
			</li>
			<li class="active">
				<a href="{{route('sinh_vien.view_all')}}">
					<i class="pe-7s-graph"></i>
					<p>Quản lý sinh viên</p>
				</a>
			</li>
			<li class="active">
				<a href="{{route('mon_hoc.view_all')}}">
					<i class="pe-7s-graph"></i>
					<p>Quản lý môn học</p>
				</a>
			</li>
			<li class="active">
				<a href="{{route('sach.view_all')}}">
					<i class="pe-7s-graph"></i>
					<p>Quản lý sách</p>
				</a>
			</li>
			<li class="active">
				<a href="{{route('thong_ke.view_all')}}">
					<i class="pe-7s-graph"></i>
					<p>Thống kê</p>
				</a>
			</li>
		</ul>
	</div>
</div>