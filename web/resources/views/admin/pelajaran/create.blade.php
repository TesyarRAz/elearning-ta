<form action="{{ route('admin.pelajaran.store')}}" method="POST">
	@csrf
	<div class="modal fade" id="modal-create-pelajaran">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<span class="modal-title">Tambah Pelajaran</span>
					<button type="button" class="close" data-dismiss="modal">X</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="pelajaran-name-create">Name</label>
						<input type="text" name="name" id="pelajaran-name-create" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="pelajaran-keterangan-create">Keterangan</label>
						<textarea name="keterangan" id="pelajaran-keterangan-create" class="form-control"></textarea>
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
	<script type="text/javascript" async>
		$(document).ready(function() {
			ClassicEditor.create(document.querySelector("#pelajaran-keterangan-create"));
		});
	</script>
@endpush