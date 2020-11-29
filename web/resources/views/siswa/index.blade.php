@extends('siswa.layout')

@section('content')
	<div class="my-3">
		<h4 class="lead mb-2">Modul Terbaru</h4>
		<hr>
		@foreach($top_moduls as $top)
			<div class="row">
				<div class="col-lg-4 col-md-5 col-6">
					<div class="card">
						<div class="card-header bg-primary text-white">
							<h5 class="card-title">{{ $top->name }}</h5>
							<span>Dibuat oleh: <b>{{ $top->guru->name }}</b></span>
						</div>
						<div class="card-body">
							{!! $top->keterangan !!}
						</div>
						<div class="card-footer bg-white clearfix">
							<div class="btn-group float-right">
								<a href="{{ route('siswa.materi.index', $top->id) }}" class="btn btn-sm btn-outline-primary">Materi <b>{{ $top->materis_count }}</b></a>
								<a href="{{ route('siswa.tes.index', $top->id) }}" class="btn btn-sm btn-outline-primary">Tes <b>{{ $top->tesses_count }}</b></button>
								<a href="#" class="btn btn-sm btn-outline-primary">Quiz <b>{{ $top->quizes_count }}</b></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
@endsection