@extends('siswa.layout')

@section('content')
	<div class="my-3">
		<div class="clearfix border-bottom pb-3 mb-2">

			<div class="float-left">
				<a href="{{ route('siswa.quiz.index', $quiz->modul_id) }}" class="d-inline-block">
					<i class="fas fa-fw fa-arrow-left"></i>
				</a>
				<h4 class="lead d-inline-block">Quiz Tanggal : {{ $quiz->created_at }}</h4>
			</div>
		</div>
		
		{!! $quiz->soal !!}

		<h4 class="lead mt-5 pb-3 border-bottom">Pojok Jawaban</h4>

		<form action="{{ route('siswa.quiz.update', [$modul->id, $quiz->id]) }}" method="POST" class="form-group">
			@csrf

			<label>Jawaban Anda</label>
			<div class="form-group">
				<textarea name="jawaban" id="quiz-jawab" class="form-control"></textarea>
				<div class="clearfix mt-2">
					<button type="submit" class="btn btn-outline-primary float-right">Kirim</button>
				</div>
			</div>
		</form>
	</div>
@endsection

@push('js')
	<script type="text/javascript" src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			CKEDITOR.replace(document.querySelector('#quiz-jawab'), {
				filebrowserUploadUrl: "{{route('post.upload', ['_token' => csrf_token() ])}}",
        		filebrowserUploadMethod: 'form'
			});
		});
	</script>
@endpush