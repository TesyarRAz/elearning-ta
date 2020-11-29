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
<div class="row vh-100 m-0 justify-content-center align-items-center">
	<div class="col-md-4">
		<div class="card card-primary">
			<div class="card-header">
				<span class="card-title">{{ config('app.name') }}</span>
			</div>
			<div class="card-body">
				@if(session()->has('status'))
					<div class="alert alert-info">
						{{ session('status') }}
					</div>
				@endif

				<form method="post" action="{{ route('postRegister') }}">
					@csrf

					@if(!isset($verification))
						<div class="input-group mb-3">
							<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama" value="{{ old('name') }}" required>

				            @error('name')
				                <div class="invalid-feedback">
				                    <strong>{{ $message }}</strong>
				                </div>
				            @enderror
						</div>

						<div class="form-group mb-3">
							<label>Gender</label>
							<div class="form-group">
								<div class="form-check form-check-inline">
								  	<input class="form-check-input" type="radio" name="gender" id="l" value="l" checked>
								  	<label class="form-check-label" for="l">Pria</label>
								</div>
								<div class="form-check form-check-inline">
								  	<input class="form-check-input" type="radio" name="gender" id="p" value="p">
								  	<label class="form-check-label" for="p">Wanita</label>
								</div>
							</div>

				            @error('gender')
				                <div class="invalid-feedback">
				                    <strong>{{ $message }}</strong>
				                </div>
				            @enderror
						</div>

						<div class="form-group mb-3">
							<label>Role</label>
							<div class="form-group">
								<div class="form-check form-check-inline">
								  	<input class="form-check-input" type="radio" name="role" id="siswa" value="siswa" checked>
								  	<label class="form-check-label" for="siswa">Siswa</label>
								</div>
								<div class="form-check form-check-inline">
								  	<input class="form-check-input" type="radio" name="role" id="guru" value="guru">
								  	<label class="form-check-label" for="guru">Guru</label>
								</div>
							</div>

				            @error('gender')
				                <div class="invalid-feedback">
				                    <strong>{{ $message }}</strong>
				                </div>
				            @enderror
						</div>
						
						<div class="input-group mb-3">
							<input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukan Email" value="{{ old('email') }}" required>

				            @error('email')
				                <div class="invalid-feedback">
				                    <strong>{{ $message }}</strong>
				                </div>
				            @enderror
						</div>
					@else
						<input type="hidden" name="verification" value="{{ $verification }}">

						<div class="input-group mb-3">
							<input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Masukan Username" value="{{ old('username') }}" required>

				            @error('username')
				                <div class="invalid-feedback">
				                    <strong>{{ $message }}</strong>
				                </div>
				            @enderror
						</div>

						<div class="input-group mb-3">
							<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukan Password" value="{{ old('password') }}" required>

				            @error('password')
				                <div class="invalid-feedback">
				                    <strong>{{ $message }}</strong>
				                </div>
				            @enderror
						</div>
					@endif

					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">
							Daftar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection