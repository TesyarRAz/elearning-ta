<template>
	<nav class="navbar navbar-expand navbar-light bg-light">
		<a href="{{ route('home') }}" class="navbar-brand">
			<img src="assets/images/logo.png" width="30" height="30" class="d-inline-block">
			Elearning
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
				</li>
			</ul>

			<!-- <ul class="navbar-nav ml-auto">
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
			</ul> -->
		</div>
	</nav>

	
</template>