@extends('adminlte::page')

@section('content')
	<div class="my-3">
		<div class="row justify-content-center">
			<div class="col-4">
				<div align="center">
					<img src="{{ $user->adminlte_image() }}" class="circle d-block">
					<h5><b>Admin</b></h5>
				</div>
			</div>
		</div>
	</div>
@endsection