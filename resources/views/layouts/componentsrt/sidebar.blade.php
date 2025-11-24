			<div class="sidebar">
				<div class="scrollbar-inner sidebar-wrapper">
					<div class="img-logo">
						<div class="img">
							<img src="{{ asset('tampilan/img/mbs.png') }}" alt="Logo" width="220" height="70">
						</div>
					</div>
					<ul class="nav">
						<li class="nav-item active">
							<a href="{{ route('rt.dashboard') }}">
								<i class="la la-table"></i>
								<p>Dashboard</p>
							</a>
						</li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                            <i class="la la-keyboard-o"></i>
                            <span class="menu-title">Table</span>
                            <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
								<li class="nav-item"> <a class="nav-link" href="{{ route('rt.tracking_surat.index')}}">Tracking Surat</a></li>
                            </ul>
                            </div>
                        </li>
					</ul>
				</div>
			</div>