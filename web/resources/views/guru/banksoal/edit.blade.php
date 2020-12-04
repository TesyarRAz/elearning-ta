<form method="POST" id="form-edit-banksoal">
	@csrf
	@method('PUT')

	<div class="modal fade" id="modal-edit-banksoal">
		<div class="modal-dialog" style="min-width: 80%">
			<div class="modal-content">
				<div class="modal-header">
					<span class="modal-title">Edit banksoal</span>
					<button class="close" data-dismiss="modal">X</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="banksoal-pelajaran-edit">Pelajaran</label>
						<select id="banksoal-pelajaran-edit" name="pelajaran_id" class="form-control" required>
							@foreach ($pelajarans as $pelajaran)
								<option value="{{ $pelajaran->id }}">{{ $pelajaran->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="banksoal-name-edit">Name</label>
						<input type="text" name="name" id="banksoal-name-edit" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="banksoal-keterangan-edit">Keterangan</label>
						<textarea name="keterangan" id="banksoal-keterangan-edit" class="form-control"></textarea>
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
			$("#banksoal-pelajaran-edit").select2();
			let editor = await CKEDITOR.replace(document.querySelector("#banksoal-keterangan-edit"), {
					filebrowserUploadUrl: "{{route('post.upload', ['_token' => csrf_token() ])}}",
            		filebrowserUploadMethod: 'form'
				});

			window.edit = function(id) {
				$.getJSON(`{{ url('guru/banksoal') }}/${id}`, data => {
					$("#form-edit-banksoal").attr('action', `{{ url('guru/banksoal') }}/${id}`);
					$("#banksoal-pelajaran-edit").val(data.pelajaran_id);
					$("#banksoal-name-edit").val(data.name);
					editor.setData(data.keterangan);

					$("#modal-edit-banksoal").modal();
				});
			}
		});
	</script>
@endpush