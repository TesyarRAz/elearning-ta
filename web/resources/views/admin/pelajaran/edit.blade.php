<form id="form-edit-pelajaran" method="POST">
	@csrf
	@method('PUT')

	<div class="modal fade" id="modal-edit-pelajaran">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<span class="modal-title">Edit Pelajaran</span>
					<button class="close" data-dismiss="modal">X</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="pelajaran-name-edit">Name</label>
						<input type="text" name="name" id="pelajaran-name-edit" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="pelajaran-keterangan-edit">Keterangan</label>
						<textarea name="keterangan" id="pelajaran-keterangan-edit" class="form-control"></textarea>
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
	<script type="text/javascript" async>
		$(document).ready(async function() {
			let editor = await ClassicEditor.create(document.querySelector("#pelajaran-keterangan-edit"));
		
			window.edit = function(id) {
				$.getJSON(`{{ url('admin/pelajaran') }}/${id}`, data => {
					$("#form-edit-pelajaran").attr('action', `{{ url('admin/pelajaran') }}/${id}`);
					$("#pelajaran-name-edit").val(data.name);
					editor.setData(data.keterangan);

					$("#modal-edit-pelajaran").modal();
				});
			}
		});
	</script>
@endpush