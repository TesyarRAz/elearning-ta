@extends('siswa.layout')

@section('content')
	<div class="my-3">
		<h4 class="lead mb-2 pb-3 border-bottom">Modul {{ $modul->name }}</h4>

		@foreach($tesses as $tes)
			<a href="{{ route('siswa.tes.show', $tes->id)}}" class="card mb-2 btn text-left btn-outline-primary">
				<div class="card-body">
					<div class="clearfix">
						<span class="float-left">{{ $tes->name }}</span>
						<!-- Query Berat ini -->
						{{-- @if(auth()->user()->siswa->isMarked($materi))
							<span class="border rounded py-1 px-2 float-right">Selesai</span>
						@endif --}}
					</div>
				</div>
			</a>
		@endforeach

		<div class="my-3">
			{{ $tesses->links() }}
		</div>
	</div>
@endsection