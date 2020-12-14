@extends('siswa.layout')

@section('content')
	<div class="my-3">
		<div class="clearfix border-bottom pb-3 mb-2">

			<div class="float-left">
				<a href="{{ route('siswa.materi.index', $materi->modul_id) }}" class="d-inline-block">
					<i class="fas fa-fw fa-arrow-left"></i>
				</a>
				<h4 class="lead d-inline-block">{{ $materi->name }}</h4>
			</div>

			@if(!auth()->user()->siswa->isMarkedMateri($materi->id))
				<a href="{{ route('siswa.materi.mark', $materi->id) }}" class="btn btn-sm btn-outline-primary float-right">
					Tandai sudah dipelajari
				</a>
				@else
				<a href="{{ route('siswa.materi.unmark', $materi->id) }}" class="btn btn-sm btn-outline-primary float-right">
					Batal Tandai Selesai
				</a>
			@endif
		</div>
		
		{!! $materi->keterangan !!}

		{{-- <h4 class="lead mt-5 pb-3 border-bottom">Pojok Komentar</h4>

		<div class="form-group">
			<label>Komentar Anda</label>
			<div class="row">
				<div class="col-6">
					<textarea class="form-control"></textarea>
				</div>
				<div class="col-2">
					<button type="submit" class="btn btn-outline-primary">Kirim</button>
				</div>
			</div>
		</div> --}}
	</div>
@endsection