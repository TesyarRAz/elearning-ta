<form action="{{ route('guru.banksoal.store')}}" method="POST">
	@csrf

	<div class="modal fade" id="modal-create-banksoal">
		<div class="modal-dialog" style="min-width: 80%">
			<div class="modal-content">
				<div class="modal-header">
					<span class="modal-title">Tambah Bank Soal</span>
					<button class="close" data-dismiss="modal">X</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="banksoal-pelajaran-create">Pelajaran</label>
						<select id="banksoal-pelajaran-create" name="pelajaran_id" class="form-control" required>
							@foreach ($pelajarans as $pelajaran)
								<option value="{{ $pelajaran->id }}">{{ $pelajaran->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="banksoal-name-create">Name</label>
						<input type="text" name="name" id="banksoal-name-create" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="banksoal-keterangan-create">Keterangan</label>
						<textarea name="keterangan" id="banksoal-keterangan-create" class="form-control"></textarea>
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
			$("#banksoal-pelajaran-create").select2();

			ClassicEditor.create(document.querySelector("#banksoal-keterangan-create"));
		});
	</script>
@endpush