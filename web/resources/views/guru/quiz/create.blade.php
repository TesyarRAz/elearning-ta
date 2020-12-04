<form action="{{ route('guru.quiz.store', [$modul->id])}}" method="POST">
	@csrf

	<div class="modal fade" id="modal-create-quiz">
		<div class="modal-dialog" style="min-width: 80%">
			<div class="modal-content">
				<div class="modal-header">
					<span class="modal-title">Tambah Quiz</span>
					<button class="close" data-dismiss="modal">X</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="quiz-soal-create">Soal</label>
						<textarea name="soal" id="quiz-soal-create" class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Tambah</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
</form>

@push('js')
	<script type="text/javascript">
		$(document).ready(function() {
			CKEDITOR.replace(document.querySelector("#quiz-soal-create"), {
				filebrowserUploadUrl: "{{route('post.upload', ['_token' => csrf_token() ])}}",
        		filebrowserUploadMethod: 'form'
			});
		});
	</script>
@endpush