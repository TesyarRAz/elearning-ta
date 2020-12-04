@extends('siswa.layout')

@section('content')
	<div class="my-3">
		<h4 class="lead mb-2 pb-3 border-bottom">{{ $tes->name }}</h4>

		<div class="border p-5">
			<div class="row mt-5 justify-content-center">
				<div class="col-3">
					<span class="text-center d-block my-4">
						Waktu Pengerjaan: {{ $tes->waktu_pengerjaan }} Menit
					</span>
					<a href="{{ route('siswa.tes.start', $tes->id) }}" class="btn btn-block btn-success">Mulai Tes</a>
				</div>
			</div>
			<div class="border mt-5 p-3">
				Catatan: {!! $tes->keterangan !!}
			</div>
		</div>
	</div>
@endsection