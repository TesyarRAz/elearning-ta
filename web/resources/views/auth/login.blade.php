@extends('adminlte::master')

@section('adminlte_css')
	<style type="text/css">
		html {
			height: 100vh;
		}
	</style>
@endsection
@section('classes_body', 'vh-100')

@section('body')
<form class="row vh-100 m-0 justify-content-center align-items-center" method="post" action="{{ route('postLogin') }}">
	@csrf

	<div class="col-xl-3 col-lg-4 d-lg-block d-md-none border p-2 h-50 m-0">
		<img src="{{ asset('assets/images/logo.png') }}" width="100%" height="100%">
	</div>

	<div class="col-xl-3 col-lg-4 col-md-5 h-50 p-0">
		<div class="border h-100 m-0">
			<div class="border-bottom p-3">
				<span>{{ config('app.name') }}</span>
			</div>
			<div class="p-3">
				<div class="input-group mb-3">
					<input type="text" name="username_email" class="form-control @error('username_email') is-invalid @enderror" placeholder="Masukan Username atau Email" value="{{ old('username_email') }}" required>

					<div class="input-group-append">
		                <div class="input-group-text">
		                    <span class="fas fa-envelope"></span>
		                </div>
		            </div>
		            @error('username_email')
		                <div class="invalid-feedback">
		                    <strong>{{ $message }}</strong>
		                </div>
		            @enderror
				</div>

				<div class="input-group mb-3">
					<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukan Password" value="{{ old('password') }}" required>

					<div class="input-group-append">
		                <div class="input-group-text">
		                    <span class="fas fa-lock"></span>
		                </div>
		            </div>
		            @error('password')
		                <div class="invalid-feedback">
		                    <strong>{{ $message }}</strong>
		                </div>
		            @enderror
				</div>
				<button type=submit class="btn btn-block btn-primary">
                    Masuk
                </button>
				{{-- <a href="#" class="btn btn-block btn-sm btn-link">
					Lupa kata sandi
				</a> --}}
				<hr>
				<a href="{{ route('register') }}" class="btn btn-block btn-success">Daftar</a>
			</div>
		</div>
	</div>
</form>
@endsection