@extends('siswa.layout')

@section('content')
	<div class="my-3">
		<h4 class="lead mb-2 pb-3 border-bottom">Modul {{ $modul->name }}</h4>

		@foreach($materis as $materi)
			<a href="{{ route('siswa.materi.show', [$modul->id, $materi->id])}}" class="card mb-2 btn text-left btn-outline-primary">
				<div class="card-body">
					<div class="clearfix">
						<span class="float-left">{{ $materi->name }}</span>
						<!-- Query Berat ini -->
						@if(auth()->user()->siswa->isMarkedMateri($materi->id))
							<span class="border rounded py-1 px-2 float-right">Selesai</span>
						@endif
					</div>
				</div>
			</a>
		@endforeach

		<div class="my-3">
			{{ $materis->links() }}
		</div>
	</div>
@endsection