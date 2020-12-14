@extends('siswa.layout')

@section('content')
<div class="my-3">
	<div class="row">
		<div class="col">
			<h4 class="lead mb-2 pb-3 border-bottom">Daftar Modul Yang Diikuti</h4>
		</div>
		<div class="col-md-3 col-5">
			<form action="{{ route('siswa.modul.index') }}" class="input-group">
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
		@foreach($moduls->map(fn($e) => $e->modul) as $top)
		<div class="col-lg-4 col-md-6 col-xs-12 my-2">
			<div class="card h-100">
				<a href="#" data-trigger="focus" data-toggle="popover" data-html="true" data-content="{!! $top->keterangan !!}">
					<img src="{{ $top->gambar ?? asset('assets/images/icon/100-book.png') }}" class="card-img-top" height="200px">
				</a>
				<div class="card-body">
					{{-- {!! $top->keterangan !!} --}}
					<h5 class="leading">{{ $top->name }}</h5>
					<span class="d-block">Dibuat oleh: <b>{{ $top->guru->name }}</b></span>
					<span class="d-block">Pelajaran: <b>{{ $top->pelajaran->name }}</b></span>
					<span class="d-block">Kelas: <b>{{ $top->kelas }}</b></span>
				</div>
				<div class="card-footer bg-white clearfix">
					<div class="btn-group float-right">
						@if(!auth()->user()->siswa->isFollowModul($top->id))
							<a href="{{ route('siswa.modul.follow', $top->id) }}" class="btn btn-sm btn-outline-primary">Follow</a>
							@else
							<a href="{{ route('siswa.modul.unfollow', $top->id) }}" class="btn btn-sm btn-outline-primary">Unfollow</a>
						@endif
						<a href="{{ route('siswa.materi.index', $top->id) }}" class="btn btn-sm btn-outline-primary">Materi <b>{{ $top->materis_count }}</b></a>
						<a href="{{ route('siswa.tes.index', $top->id) }}" class="btn btn-sm btn-outline-primary">Tes <b>{{ $top->tesses_count }}</b></a>
						<a href="{{ route('siswa.quiz.index', $top->id) }}" class="btn btn-sm btn-outline-primary">Quiz <b>{{ $top->quizes_count }}</b></a>
					</div>
				</div>
			</div>
		</div>
		@endforeach	
	</div>

	<div class="my-2">
		{{ $moduls->links() }}
	</div>
</div>
@endsection

@push('js')
	<script type="text/javascript">
		$(function () {
		  $('[data-toggle="popover"]').popover({
		  	trigger: 'focus'
		  })
		});
	</script>
@endpush