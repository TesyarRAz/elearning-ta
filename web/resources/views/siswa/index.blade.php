@extends('siswa.layout')

@section('content')
<div class="my-3">
	<div class="row">
		<div class="col">
			<h4 class="lead mb-2 pb-3 border-bottom">Daftar Modul</h4>
		</div>
		<div class="col-md-3 col-5">
			<form action="{{ route('siswa.index') }}" class="input-group">
				<input type="search" name="search" class="form-control" placeholder="Search">
				<div class="input-group-append">
					<button class="btn btn-outline-primary">
						<i class="fas fa-fw fa-search"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
	
	<div class="row">
		@foreach($top_moduls as $top)
		<div class="col-lg-4 col-md-5">
			<div class="card h-100">
				<div class="card-header bg-primary text-white">
					<h5 class="card-title">{{ $top->name }}</h5>
					<span class="d-block">Dibuat oleh: <b>{{ $top->guru->name }}</b></span>
					<span class="d-block">Pelajaran: <b>{{ $top->pelajaran->name }}</b></span>
					<span class="d-block">Kelas: <b>{{ $top->kelas }}</b></span>
				</div>
				<div class="card-body">
					{!! $top->keterangan !!}
				</div>
				<div class="card-footer bg-white clearfix">
					<div class="btn-group float-right">
						<a href="{{ route('siswa.materi.index', $top->id) }}" class="btn btn-sm btn-outline-primary">Materi <b>{{ $top->materis_count }}</b></a>
						<a href="{{ route('siswa.tes.index', $top->id) }}" class="btn btn-sm btn-outline-primary">Tes <b>{{ $top->tesses_count }}</b></a>
						<a href="#" class="btn btn-sm btn-outline-primary">Quiz <b>{{ $top->quizes_count }}</b></a>
					</div>
				</div>
			</div>
		</div>
		@endforeach	
	</div>

	<div class="my-2">
		{{ $top_moduls->links() }}
	</div>
</div>
@endsection