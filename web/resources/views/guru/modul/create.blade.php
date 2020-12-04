<form action="{{ route('guru.modul.store')}}" method="POST">
	@csrf

	<div class="modal fade" id="modal-create-modul">
		<div class="modal-dialog" style="min-width: 80%">
			<div class="modal-content">
				<div class="modal-header">
					<span class="modal-title">Tambah Modul</span>
					<button class="close" data-dismiss="modal">X</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="modul-pelajaran-create">Pelajaran</label>
						<select id="modul-pelajaran-create" name="pelajaran_id" class="form-control" required>
							@foreach ($pelajarans as $pelajaran)
								<option value="{{ $pelajaran->id }}">{{ $pelajaran->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="modul-name-create">Name</label>
						<input type="text" name="name" id="modul-name-create" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="modul-kelas-create">Kelas</label>
						<input type="text" name="kelas" id="modul-kelas-create" class="form-control" required>
					</div>

					<div class="form-group">
						<label>Password</label>
						<div class="form-check">
							<input type="checkbox" class="form-check-input" id="modul-password-create" name="use_password">
							<label for="modul-password-create" class="form-check-label">Active</label>
						</div>
					</div>
					<div class="form-group">
						<label for="modul-keterangan-create">Keterangan</label>
						<textarea name="keterangan" id="modul-keterangan-create" class="form-control"></textarea>
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
			$("#modul-pelajaran-create").select2();
			
			CKEDITOR.replace(
				document.querySelector("#modul-keterangan-create"),
				{
					filebrowserUploadUrl: "{{route('post.upload', ['_token' => csrf_token() ])}}",
            		filebrowserUploadMethod: 'form',
				}
			);
		});
	</script>
@endpush