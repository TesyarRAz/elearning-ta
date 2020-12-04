<form method="POST" id="form-edit-modul">
	@csrf
	@method('PUT')

	<div class="modal fade" id="modal-edit-modul">
		<div class="modal-dialog" style="min-width: 80%">
			<div class="modal-content">
				<div class="modal-header">
					<span class="modal-title">Edit Modul</span>
					<button class="close" data-dismiss="modal">X</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="modul-pelajaran-edit">Pelajaran</label>
						<select id="modul-pelajaran-edit" name="pelajaran_id" class="form-control" required>
							@foreach ($pelajarans as $pelajaran)
								<option value="{{ $pelajaran->id }}">{{ $pelajaran->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="modul-name-edit">Name</label>
						<input type="text" name="name" id="modul-name-edit" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="modul-kelas-edit">Kelas</label>
						<input type="text" name="kelas" id="modul-kelas-edit" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Password</label>
						<div class="form-check">
							<input type="checkbox" class="form-check-input" id="modul-password-edit" name="use_password">
							<label for="modul-password-edit" class="form-check-label">Active</label>
						</div>
					</div>
					<div class="form-group">
						<label for="modul-keterangan-edit">Keterangan</label>
						<textarea name="keterangan" id="modul-keterangan-edit" class="form-control"></textarea>
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
			$("#modul-pelajaran-edit").select2();
			let editor = await CKEDITOR.replace(
				document.querySelector("#modul-keterangan-edit"), {
				filebrowserUploadUrl: "{{route('post.upload', ['_token' => csrf_token() ])}}",
        		filebrowserUploadMethod: 'form'
			});

			window.edit = function(id) {
				$.getJSON(`{{ url('guru/modul') }}/${id}`, data => {
					$("#form-edit-modul").attr('action', `{{ url('guru/modul') }}/${id}`);
					$("#modul-pelajaran-edit").val(data.pelajaran_id);
					$("#modul-name-edit").val(data.name);
					$("#modul-kelas-edit").val(data.kelas);
					$("#modul-password-edit").attr('checked', data.password != null);
					
					editor.setData(data.keterangan);

					$("#modal-edit-modul").modal();
				});
			}
		});
	</script>
@endpush