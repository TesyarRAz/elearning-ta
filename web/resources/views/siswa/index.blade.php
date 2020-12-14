@extends('siswa.layout')

@section('content')
	<!-- Carousel Start -->
	<div id="homecarousel" class="carousel slide" data-ride="carousel" style="background-color: #5D97AF">
		<ol class="carousel-indicators">
			<li data-target="#homecarousel" data-slide-to="0" class="active"></li>
			<li data-target="#homecarousel" data-slide-to="1"></li>
			<li data-target="#homecarousel" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img width="100%" height="500px" class="d-block w-100" src="{{ asset('assets/images/carousel/undraw_mathematics_4otb.png') }}" alt="Reading Book">
				<div class="carousel-caption d-none d-md-block">
					<h5>Pembelajaran Per Modul</h5>
					<p>
						Dengan ini memudahkan anda ketika mempelajari sebuah bahasan, anda tidak perlu pusing lagi mencari materi satu per satu
					</p>
				</div>
			</div>
			<div class="carousel-item">
				<img width="100%" height="500px" class="d-block w-100" src="{{ asset('assets/images/carousel/undraw_teacher_35j2.png')}}" alt="Second slide">
				<div class="carousel-caption d-none d-md-block">
					<h5>Pengajar yang Siap Memberikan Pembelajaran</h5>
					<p>
						Terbukanya aplikasi bagi siapa saja yang ingin mengajar memudahkan kita ketika mencari pembelajaran yang diberikan oleh banyar pengajar
					</p>
				</div>
			</div>
			<div class="carousel-item">
				<img width="100%" height="500px" class="d-block w-100" src="{{ asset('assets/images/carousel/undraw_online_test_gba7.png') }}" alt="Third slide">
				<div class="carousel-caption d-none d-md-block">
					<h5>Tes dan Quiz</h5>
					<p>
						Penilaian diri menjadi lebih mudah ketika pengajar akan memberikan tugas maupun quiz
					</p>
				</div>
			</div>
		</div>
		<a class="carousel-control-prev" href="#homecarousel" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#homecarousel" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<!-- Carousel End -->
<div class="my-3">
	<div class="row mt-5">
		<div class="col">
			<h4 class="lead mb-2 pb-3 border-bottom">Daftar Modul</h4>
		</div>
		<div class="col-md-3 col-5">
			<form action="{{ route('siswa.index') }}" method="get" class="input-group">
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
		<div class="col-lg-4 col-md-6 col-xs-12 my-2">
			<div class="card h-100">
				<div class="card-header bg-white text-white">
					<a href="#" data-trigger="focus" data-toggle="popover" data-html="true" data-content="{!! $top->keterangan !!}">
						<img src="{{ $top->gambar ?? asset('assets/images/icon/module.png') }}" class="card-img-top" height="200px" @empty($top->gambar) style="filter: invert(1);" @endempty>
					</a>
				</div>
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
		{{ $top_moduls->links() }}
	</div>
</div>
@endsection

@push('js')
	<script type="text/javascript">
		$(function () {
			$('[data-toggle="popover"]').popover({
				trigger: 'focus'
			})
			$('[data-toggle="popover"]').on('click', function(e) {
				e.preventDefault();
				$(this).popover({
					trigger: 'focus'
				})
			})
		});
	</script>
@endpush