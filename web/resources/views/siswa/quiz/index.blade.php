@extends('siswa.layout')

@section('content')
	<div class="my-3">
		<h4 class="lead mb-2 pb-3 border-bottom">Modul {{ $modul->name }}</h4>

		@foreach($quizes as $quiz)
			<a href="{{ route('siswa.quiz.show', [$modul->id, $quiz->id])}}" class="card mb-2 btn text-left btn-outline-primary">
				<div class="card-body">
					<div class="clearfix">
						<span class="float-left">{{ $quiz->created_at }}</span>
					</div>
				</div>
			</a>
		@endforeach

		<div class="my-3">
			{{ $quizes->links() }}
		</div>
	</div>
@endsection