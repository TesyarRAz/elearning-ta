@extends('adminlte::page')

@section('content')
	<div class="my-3">
		<div class="row justify-content-center">
			<div class="col-4">
				<div align="center">
					<img src="{{ $user->adminlte_image() }}" class="circle d-block">
					<h5><b>{{ $user->role()->name }}</b></h5>
					<span class="d-block"><b>{{ $user->role()->alamat }}</b></span>
				</div>
			</div>
		</div>
	</div>
@endsection