<form method="POST" id="form-edit-quiz">
	@csrf
	@method('PUT')

	<div class="modal fade" id="modal-edit-quiz">
		<div class="modal-dialog" style="min-width: 80%">
			<div class="modal-content">
				<div class="modal-header">
					<span class="modal-title">Edit Materi</span>
					<button class="close" data-dismiss="modal">X</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="quiz-soal-edit">Soal</label>
						<textarea name="soal" id="quiz-soal-edit" class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Edit</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
</form>

@push('js')
	<script type="text/javascript">
		$(document).ready(async function() {
			let editor = await CKEDITOR.replace(document.querySelector("#quiz-soal-edit"), {
				filebrowserUploadUrl: "{{route('post.upload', ['_token' => csrf_token() ])}}",
        		filebrowserUploadMethod: 'form'
			});

			window.edit = function(id) {
				$.getJSON(`{{ url('guru/modul/'. $modul->id) }}/quiz/${id}`, data => {
					$("#form-edit-quiz").attr('action', `{{ url('guru/modul/' . $modul->id) }}/quiz/${id}`);
					editor.setData(data.soal);

					$("#modal-edit-quiz").modal();
				});
			}
		});
	</script>
@endpush