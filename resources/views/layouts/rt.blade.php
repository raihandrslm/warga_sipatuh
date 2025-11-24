<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Petugas Sipatuh</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="{{ asset('tampilan/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('tampilan/css/ready.css') }}">
	<link rel="stylesheet" href="{{ asset('tampilan/css/demo.css') }}">
	
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
				<a href="{{ route('rt.dashboard') }}" class="logo">
					Petugas Dashboard
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>

            {{-- Header & Sidebar --}}
            @include('layouts.componentsrt.header')
            @include('layouts.componentsrt.sidebar')

			<div class="main-panel">
				<div class="content">
                    {{-- INI TEMPAT GANTI HALAMAN --}}
					@yield('content')
				</div>

                {{-- Footer --}}
                @include('layouts.componentsrt.footer')
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h6 class="modal-title"><i class="la la-frown-o"></i> Under Development</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">									
					<p>Currently the pro version of the <b>Ready Dashboard</b> Bootstrap is in progress development</p>
					<p><b>We'll let you know when it's done</b></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	{{-- JS --}}
	<script src="{{ asset('tampilan/js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('tampilan/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('tampilan/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('tampilan/js/core/bootstrap.min.js') }}"></script>
	<script src="{{ asset('tampilan/js/plugin/chartist/chartist.min.js') }}"></script>
	<script src="{{ asset('tampilan/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js') }}"></script>
	<script src="{{ asset('tampilan/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
	<script src="{{ asset('tampilan/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
	<script src="{{ asset('tampilan/js/plugin/jquery-mapael/jquery.mapael.min.js') }}"></script>
	<script src="{{ asset('tampilan/js/plugin/jquery-mapael/maps/world_countries.min.js') }}"></script>
	<script src="{{ asset('tampilan/js/plugin/chart-circle/circles.min.js') }}"></script>
	<script src="{{ asset('tampilan/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
	<script src="{{ asset('tampilan/js/ready.min.js') }}"></script>
	<script src="{{ asset('tampilan/js/demo.js') }}"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>
</html>
