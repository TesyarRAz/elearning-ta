<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>{{ config('app.name') }}</title>

	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="initial-scale=1, width=device-width, shrink-to-fit=no">

	<!-- CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

	@stack('css')
</head>
<body>
	<nav class="navbar navbar-expand-md navbar-light bg-light">
		<a href="{{ route('home') }}" class="navbar-brand">
			<img src="{{ asset('assets/images/logo.png') }}" width="30" height="30" class="d-inline-block">
			Elearning
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a href="{{ route('siswa.nilai.index') }}" class="nav-link">Nilai</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('siswa.modul.index') }}" class="nav-link">Modul</a>
				</li>
			</ul>

			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-fw fa-user"></i>{{ auth()->user()->role()->name }}
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
						<a href="{{ route('siswa.profile') }}" class="dropdown-item">Profile</a>
						<button onclick="$('#form-logout').submit()" class="dropdown-item">Logout</button>

						<form id="form-logout" action="{{ route('logout') }}" method="POST">
							@csrf
						</form>
					</div>
				</li>
			</ul>
		</div>
	</nav>

	<div class="container mt-3">
		@if(session()->has('status'))
			<div class="alert alert-info">
				<p>{{ session('status') }}</p>
			</div>
		@endif

		@if($errors->any())
			<div class="alert alert-danger">
				<p>{{ $errors->first() }}</p>
			</div>
		@endif
		
		@yield('content')
	</div>

	<!-- jQuery and JS bundle w/ Popper.js -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

	@stack('js')
</body>
</html>
