@extends('siswa.layout')

@push('css')
	<style type="text/css">
		.tile:hover {
			background-color: #007bff;
			color: white;
			text-decoration: none;
			font-size: 18px;
		}

		.tile {
			color: black;
			transition: font-size .5s;
		}
	</style>
@endpush

@section('content')
	<div class="my-3">
		<h4 class="lead mb-2 pb-3 border-bottom">Modul {{ $modul->name }}</h4>

		@foreach($tesses as $tes)
			<a href="{{ route('siswa.tes.show', $tes->id)}}" class="card mb-2 tile">
				<div class="card-body">
					{{ $tes->name }}
				</div>
			</a>
		@endforeach

		<div class="my-3">
			{{ $tesses->links() }}
		</div>
	</div>
@endsection