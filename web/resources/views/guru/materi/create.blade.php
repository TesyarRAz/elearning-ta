<form action="{{ route('guru.materi.store', [$modul->id])}}" method="POST">
	@csrf

	<div class="modal fade" id="modal-create-materi">
		<div class="modal-dialog" style="min-width: 80%">
			<div class="modal-content">
				<div class="modal-header">
					<span class="modal-title">Tambah Materi</span>
					<button class="close" data-dismiss="modal">X</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="materi-name-create">Name</label>
						<input type="text" name="name" id="materi-name-create" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="materi-keterangan-create">Keterangan</label>
						<textarea name="keterangan" id="materi-keterangan-create" class="form-control"></textarea>
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
			ClassicEditor.create(document.querySelector("#materi-keterangan-create"));
		});
	</script>
@endpush