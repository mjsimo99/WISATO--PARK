@auth
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
	{{-- <title>{{ ($settings->site_title) ? $settings->site_title : config('app.name', 'Demo Parking') }} @yield('title') --}}
	</title>
	<!-- plugins:js -->
	<script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
	<!-- plugins:css -->
	<link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
	<!-- endinject -->
	
	<link rel="stylesheet" href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" />
	<!-- End plugin css for this page -->
	<!-- datatable css -->
	<link rel="stylesheet" href="{{asset('assets/css/datatable/dataTables.bootstrap4.min.css')}}" />
	<link rel="stylesheet" href="{{asset('assets/css/datatable/buttons.bootstrap4.min.css')}}" />

	<!-- sweet-alert2 css -->
	<link rel="stylesheet" href="{{asset('assets/vendors/sweet-alert2/sweetalert2.min.css')}}" />

	<link rel="stylesheet" href="{{asset('assets/vendors/datepicker/jquery.datetimepicker.min.css')}}" />

	<!-- Layout styles -->
	<link rel="stylesheet" href="{{asset('assets/css/main/style.css')}}" />
	<link rel="stylesheet" href="{{asset('css/site.css')}}" />
	  <script src="https://cdn.tailwindcss.com"></script>

	<!-- End layout styles -->
	{{-- <link rel="shortcut icon" href="{{asset($settings->favicon)}}" /> --}}
	@stack('css')
</head>

<body>
	<div class="container-scroller">
		<!-- partial:partials/_sidebar.html -->
		<nav class="sidebar sidebar-offcanvas" id="sidebar">
			<ul class="nav">
				<li class="nav-item">
					<a class="nav-link d-block" href="{{url('/')}}">
						{{-- <img class="sidebar-brand-logo" src="{{asset($settings->logo)}}" alt="" /> --}}
					</a>
				</li>
				<li class="pt-2 pb-1">
					<span class="nav-item-head">The Best Parking Solution</span>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('home')}}">
						<i class="mdi mdi-compass-outline menu-icon"></i>
						<span class="menu-title">Dashboard</span>
					</a>
				</li>

				{{-- @if(Auth::user()->hasRole('admin')) --}}
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="collapse" href="#ui-user-management" aria-expanded="false"
						aria-controls="ui-user-management">
						<i class="mdi mdi-account menu-icon"></i>
						<span class="menu-title">User</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="collapse" id="ui-user-management">
						<ul class="nav flex-column sub-menu">
							<li class="nav-item">
								{{-- <a class="nav-link" href="{{route('user.create')}}">Add User</a> --}}
							</li>
							<li class="nav-item">
								{{-- <a class="nav-link" href="{{route('user.list')}}">User List</a> --}}
							</li>
						</ul>
					</div>
				</li>

				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="collapse" href="#ui-category" aria-expanded="false"
						aria-controls="ui-category">
						<i class="mdi mdi-tag-multiple menu-icon"></i>
						<span class="menu-title">Category</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="collapse" id="ui-category">
						<ul class="nav flex-column sub-menu">
							<li class="nav-item">
								{{-- <a class="nav-link" href="{{route('category.create')}}">Add Category</a> --}}
							</li>
							<li class="nav-item">
								{{-- <a class="nav-link" href="{{route('category.index')}}">Category List</a> --}}
							</li>
						</ul>
					</div>
				</li>

				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="collapse" href="#ui-floor" aria-expanded="false"
						aria-controls="ui-floor">
						<i class="mdi mdi-layers menu-icon"></i>
						<span class="menu-title">Floor</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="collapse" id="ui-floor">
						<ul class="nav flex-column sub-menu">
							<li class="nav-item">
								{{-- <a class="nav-link" href="{{route('floors.create')}}">Add Floor</a> --}}
							</li>
							<li class="nav-item">
								{{-- <a class="nav-link" href="{{route('floors.index')}}">Floor List</a> --}}
							</li>
						</ul>
					</div>
				</li>

				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="collapse" href="#ui-tariff" aria-expanded="false"
						aria-controls="ui-tariff">
						<i class="mdi mdi mdi-cash-multiple menu-icon"></i>
						<span class="menu-title">Tariff</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="collapse" id="ui-tariff">
						<ul class="nav flex-column sub-menu">
							<li class="nav-item">
								{{-- <a class="nav-link" href="{{route('tariff.create')}}">Add Tariff</a> --}}
								f"dzdz"
							</li>
							<li class="nav-item">
								{{-- <a class="nav-link" href="{{route('tariff.index')}}">Tariff List</a> --}}
							</li>
						</ul>
					</div>
				</li>

				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="collapse" href="#ui-parking-setup" aria-expanded="false"
						aria-controls="ui-parking-setup">
						<i class="mdi mdi mdi-home-map-marker menu-icon"></i>
						<span class="menu-title">Parking Setup</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="collapse" id="ui-parking-setup">
						<ul class="nav flex-column sub-menu">
							<li class="nav-item">
								{{-- <a class="nav-link" href="{{route('parking_settings.create')}}">Add Slot</a> --}}
							</li>
							<li class="nav-item">
								{{-- <a class="nav-link" href="{{route('parking_settings.index')}}">Slot List</a> --}}
							</li>
						</ul>
					</div>
				</li>

				@endif
				{{-- @if(Auth::user()->hasRole(['admin','operator'])) --}}

				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="collapse" href="#ui-parking" aria-expanded="false"
						aria-controls="ui-parking">
						<i class="mdi mdi-car menu-icon"></i>
						<span class="menu-title">Parking</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="collapse" id="ui-parking">
						<ul class="nav flex-column sub-menu">
							<li class="nav-item">
								{{-- <a class="nav-link" href="{{route('parking.create')}}">Add Parking</a> --}}
							</li>
							<li class="nav-item">
								{{-- <a class="nav-link" href="{{route('parking.index')}}">All Parking List</a> --}}
							</li>
							<li class="nav-item">
								{{-- <a class="nav-link" href="{{route('parking.current_list')}}">Currnetly Parking List</a> --}}
							</li>
							<li class="nav-item">
								{{-- <a class="nav-link" href="{{route('parking.ended_list')}}">Ended Parking List</a> --}}
							</li>
						</ul>
					</div>
				</li>

				{{-- @endif --}}
				{{-- @if(Auth::user()->hasRole('admin')) --}}
				<li class="nav-item">
					{{-- <a class="nav-link" href="{{ route('reports.index') }}"> --}}
						<i class="mdi mdi-file-document menu-icon"></i>
						<span class="menu-title">Reports</span>
					</a>
				</li>
				<li class="nav-item">
					{{-- <a class="nav-link" href="{{ route('settings.create') }}"> --}}
						<i class="mdi mdi-brightness-7 menu-icon"></i>
						<span class="menu-title">Settings</span>
					</a>
				</li>
				{{-- @endif --}}
				<li class="nav-item">
					{{-- <a class="nav-link" href="{{ route('user.profile') }}"> --}}
						<i class="mdi mdi-ticket-account menu-icon"></i>
						<span class="menu-title">My Profile</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="javascript:window.history.go(-1);">
						<i class="mdi mdi-chevron-double-left menu-icon"></i>
						<span class="menu-title">Go Back</span>
					</a>
				</li>
			</ul>
		</nav>
		<!-- partial -->
		<div class="container-fluid page-body-wrapper">
			<!-- partial:partials/_navbar.html -->
			<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
				<div class="navbar-menu-wrapper d-flex align-items-stretch">
					<button class="navbar-toggler navbar-toggler align-self-center" type="button"
						data-toggle="minimize">
						<span class="mdi mdi-chevron-double-left"></span>
					</button>
					<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
						<a class="navbar-brand brand-logo-mini" href="{{route('home')}}"><img
								{{-- src="{{asset($settings->logo)}}" alt="logo" /></a> --}}
					</div>
					<ul class="navbar-nav">
						<li class="nav-item dropdown d-none">
							<a class="nav-link" id="messageDropdown" href="#" data-bs-toggle="dropdown"
								aria-expanded="false">
								<i class="mdi mdi-email-outline"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-left navbar-dropdown preview-list"
								aria-labelledby="messageDropdown">
								<h6 class="p-3 mb-0 font-weight-semibold">Messages</h6>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item preview-item">
									<div class="preview-thumbnail">
										<img src="#" alt="image" alt="" class="profile-pic">
									</div>
									<div
										class="preview-item-content d-flex align-items-start flex-column justify-content-center">
										<h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a
											message</h6>
										<p class="text-gray mb-0"> 1 Minutes ago </p>
									</div>
								</a>
								<div class="dropdown-divider"></div>
								<h6 class="p-3 mb-0 text-center text-primary font-13">4 new messages</h6>
							</div>
						</li>
						<li class="nav-item dropdown ms-3 d-none">
							<a class="nav-link" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
								<i class="mdi mdi-bell-outline"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-left navbar-dropdown preview-list"
								aria-labelledby="notificationDropdown">
								<h6 class="px-3 py-3 font-weight-semibold mb-0">Notifications</h6>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item preview-item">
									<div class="preview-thumbnail">
										<div class="preview-icon bg-success">
											<i class="mdi mdi-calendar"></i>
										</div>
									</div>
									<div
										class="preview-item-content d-flex align-items-start flex-column justify-content-center">
										<h6 class="preview-subject font-weight-normal mb-0">New order recieved</h6>
										<p class="text-gray ellipsis mb-0"> 45 sec ago </p>
									</div>
								</a>

								<div class="dropdown-divider"></div>
								<h6 class="p-3 font-13 mb-0 text-primary text-center">View all notifications</h6>
							</div>
						</li>
					</ul>
					<ul class="navbar-nav navbar-nav-right">
						<li class="nav-item nav-profile dropdown d-none d-md-block">
							<a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
								aria-expanded="false">
								<div class="nav-profile-text"><i
										class="mdi mdi-account-circle mb-1 position-relative t-2"></i><span>{{
										auth()->user()->name }}</span></div>
							</a>
							<div class="dropdown-menu center navbar-dropdown" aria-labelledby="profileDropdown">
								{{-- <a class="dropdown-item" href="{{ route('user.profile') }}"> --}}
									<i class="mdi mdi-account-box me-3"></i> Profile </a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" id="logOut">
									<i class="mdi mdi-logout-variant me-3"></i> {{ __('Logout') }}
								</a>

								<form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
									@csrf
								</form>

							</div>
						</li>
					</ul>
					<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
						data-toggle="offcanvas">
						<span class="mdi mdi-menu"></span>
					</button>
				</div>
			</nav>
			<!-- partial -->
			<div class="main-panel">

				<div class="content-wrapper pb-0">

					<!-- first row starts here -->
					<?php	
						$msg = session('flashMsg') ?? $flashMsg ?? null;
						if ($msg) {
					?>
					<div class="d-none flashMessage">
						<div id="msgType">{{ $msg['type'] }}</div>
						<div id="msg">{{ $msg['msg'] }}</div>
					</div>
					<?php
						}
					?>
					@yield('content')


					<!-- content-wrapper ends -->
				</div>
				<!-- main-panel ends -->
			</div>
			<!-- page-body-wrapper ends -->
		</div>

		<!-- container-scroller -->
		<!--datatable-->
		<script src="{{asset('assets/js/datatable/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('assets/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
		<script src="{{asset('assets/js/datatable/dataTables.buttons.min.js')}}"></script>
		<script src="{{asset('assets/js/datatable/buttons.bootstrap4.min.js')}}"></script>
		<script src="{{asset('assets/js/datatable/buttons.html5.min.js')}}"></script>
		<script src="{{asset('assets/js/datatable/buttons.print.min.js')}}"></script>

		<!-- sweet-alert2 css -->
		<link rel="stylesheet" href="{{asset('assets/vendors/sweet-alert2/sweetalert2.min.css')}}" />


		<!-- Plugin js for this page -->
		<script src="{{ asset('js/app.js') }}"></script>
		<script type="text/javascript">
			Ziggy.url = "{{url('/')}}";
				@if($_SERVER['SERVER_PORT'] != 80 || $_SERVER['SERVER_PORT'] != 443)
				Ziggy.port = {{$_SERVER['SERVER_PORT']}};
				@endif
		</script>
		<script src="{{asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
		<script src="{{asset('assets/js/jquery.cookie.js')}}" type="text/javascript"></script>
		<!-- End plugin js for this page -->
		<!-- inject:js -->
		<script src="{{asset('assets/js/off-canvas.js')}}"></script>
		<script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
		<script src="{{asset('assets/js/misc.js')}}"></script>
		<script src="{{asset('assets/js/settings.js')}}"></script>
		<script src="{{asset('assets/js/todolist.js')}}"></script>
		<script src="{{asset('assets/vendors/datepicker/jquery.datetimepicker.full.min.js')}}"></script>
		<script src="{{asset('assets/vendors/sweet-alert2/sweetalert2.all.min.js')}}"></script>
		<script src="{{asset('js/site.js')}}"></script>
		@stack('scripts')
		<!-- endinject -->
		<!-- End custom js for this page -->
		<script>
			const currentPath='{{request()->path()}}';
		</script>
</body>

</html>
{{-- @endauth --}}
@guest
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ ($settings->site_title) ? $settings->site_title : config('app.name', 'dParking') }}</title>
	<link rel="icon" type="image/x-icon" href="{{asset($settings->favicon)}}">

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

	<!-- Styles -->
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />
	<link href="{{ asset('css/public_site.css') }}" rel="stylesheet">
</head>

<body>
	<div id="app">
		<nav class="nav-bg">
			<div class="container">
				<a class="m-0 navbar-brand p-0 color-white" href="{{ url('/') }}">
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse"
					data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
					aria-label="{{ __('Toggle navigation') }}">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<!-- Left Side Of Navbar -->
					<ul class="navbar-nav mr-auto">

					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="navbar-nav ml-auto">
						<!-- Authentication Links -->
						@guest
						<li class="nav-item">
							<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
						</li>
						@else
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" id="guest-log-out">
									{{ __('Logout') }}
								</a>

								<form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
									@csrf
								</form>
							</div>
						</li>
						@endguest
					</ul>
				</div>
			</div>
		</nav>

		<main class="">
			@yield('content')
		</main>
	</div>
	<script src="{{asset('js/login.js')}}"></script>
</body>

</html>
@endguest