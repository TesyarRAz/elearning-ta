<form method="POST" id="form-edit-materi">
	@csrf
	@method('PUT')

	<div class="modal fade" id="modal-edit-materi">
		<div class="modal-dialog" style="min-width: 80%">
			<div class="modal-content">
				<div class="modal-header">
					<span class="modal-title">Edit Materi</span>
					<button class="close" data-dismiss="modal">X</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="materi-name-edit">Name</label>
						<input type="text" name="name" id="materi-name-edit" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="materi-keterangan-edit">Keterangan</label>
						<textarea name="keterangan" id="materi-keterangan-edit" class="form-control"></textarea>
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
			let editor = await CKEDITOR.replace(document.querySelector("#materi-keterangan-edit"), {
					filebrowserUploadUrl: "{{route('post.upload', ['_token' => csrf_token() ])}}",
            		filebrowserUploadMethod: 'form'
				});

			window.edit = function(id) {
				$.getJSON(`{{ url('guru/modul/'. $modul->id) }}/materi/${id}`, data => {
					$("#form-edit-materi").attr('action', `{{ url('guru/modul/' . $modul->id) }}/materi/${id}`);
					$("#materi-name-edit").val(data.name);
					editor.setData(data.keterangan);

					$("#modal-edit-materi").modal();
				});
			}
		});
	</script>
@endpush