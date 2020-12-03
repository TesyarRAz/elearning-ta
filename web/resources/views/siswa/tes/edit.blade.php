@extends('siswa.layout')

@section('content')
	<div class="my-3">
		<h4 class="lead mb-2 pb-3 border-bottom">{{ $tes->name }}</h4>

		<div class="my-5">
			<div class="border rounded p-5" style="min-height: 80vh; position: relative; z-index: 1">
				<input type="hidden" name="soal_id" value="{{ $soal->id }}">
				<input type="hidden" name="current_page" value="{{ $data->currentPage() }}">

				<div class="position-absolute bg-dark m-2 text-white p-2 rounded" style="z-index: 1; top: 0; right: 0" id="countdown-timer"></div>

				<div style="min-height: 100%">
					{{ $data->currentPage() }}. {!! $soal->soal !!}
					<div class="mt-3 mb-5">

						@foreach($soal->pilihans()->inRandomOrder()->get() as $p)
							<div class="form-check my-2">
								<input type="radio" name="pilihan_id" value="{{ $p->id }}" id="pilihan-{{$loop->index}}" onchange="update({{$p->id}})" class="form-check-input" {{ $siswa_tes->pilihans->contains('pilihan_id', $p->id) ? 'checked' : '' }}>

								<label class="form-check-label" for="pilihan-{{$loop->index}}">{{ $p->pilihan }}</label>
							</div>
						@endforeach
					</div>
				</div>

				@if($data->currentPage() >= $data->lastPage())
					<div class="position-absolute m-2" style="z-index: 1; bottom: 0; right: 0">
						<a href="{{ route('siswa.tes.selesai', [$tes->id, $siswa_tes->id]) }}" type="submit" class="btn btn-outline-primary" onclick="return confirm('Yakin sudah selesai?')">Selesai</a>
					</div>
				@endif
				@if($data->currentPage() < $data->lastPage())
					<div class="position-absolute m-2" style="z-index: 1; bottom: 0; right: 0">
						<a href="{{ $data->nextPageUrl() }}" type="submit" class="btn btn-outline-primary">Berikutnya</a>
					</div>
				@endif
				@if($data->currentPage() > 1)
					<div class="position-absolute m-2" style="z-index: 1; bottom: 0; left: 0">
						<a href="{{ $data->previousPageUrl() }}" type="submit" class="btn btn-outline-primary">Sebelumnya</a>
					</div>
				@endif
			</div>

			<div class="my-2">
				{{ $data->onEachSide(10)->withQueryString()->links() }}
			</div>
		</div>
	</div>
@endsection


@push('js')
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js" integrity="sha512-lteuRD+aUENrZPTXWFRPTBcDDxIGWe5uu0apPEn+3ZKYDwDaEErIK9rvR0QzUGmUQ55KFE2RqGTVoZsKctGMVw==" crossorigin="anonymous"></script>

	<script type="text/javascript">
		function update(pilihan_id) {
			$.post('{{ route('siswa.tes.update', [$tes->id, $siswa_tes->id]) }}', {
				soal_id: {{ $soal->id }},
				pilihan_id,
				'_token': $("meta[name=csrf-token]").attr('content')
			}, function(data, status) {

			});
		}

		$(document).ready(function() {
			(function() {
				$("#countdown-timer")
					.countdown('{{ $siswa_tes->sisa_waktu->format('Y/m/d H:i:s') }}')
					.on('update.countdown', function(event) {
						$(this).text(
					      	event.strftime('%H:%M:%S')
					    );
					})
					.on('finish.countdown', function() {
						document.location.href = "{{ route('siswa.tes.selesai', [$tes->id, $siswa_tes->id]) }}";
					});
			})();
		});
	</script>
@endpush