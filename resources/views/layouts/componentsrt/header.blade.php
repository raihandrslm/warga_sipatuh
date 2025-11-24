			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">	
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="{{ asset('tampilan/img/mbs.png') }}" alt="user-img" width="100" class="img"><span ></span></span> </a>
							<ul class="dropdown-menu dropdown-user">
								<li>
									<div class="user-box">
										<div class="u-img"><img src="{{ asset('tampilan/img/mbs.png') }}" alt="user"></div>
										<div class="u-text">
											<h4>Petugas RT</h4>
										</div>
									</li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ route('logout') }}"
										onclick="event.preventDefault();
													document.getElementById('logout-form').submit();">
											<i class="fa fa-power-off"></i> Logout
										</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
											@csrf
										</form>
								</ul>
							</li>
						</ul>
					</div>
				</nav>
			</div>