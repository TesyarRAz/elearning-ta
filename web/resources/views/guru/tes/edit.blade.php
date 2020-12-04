<form method="POST" id="form-edit-modul">
	@csrf
	@method('PUT')

	<div class="modal fade" id="modal-edit-tes">
		<div class="modal-dialog" style="min-width: 80%">
			<div class="modal-content">
				<div class="modal-header">
					<span class="modal-title">Edit tes</span>
					<button class="close" data-dismiss="modal">X</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="tes-banksoal-edit">Bank Soal</label>
						<select id="tes-banksoal-edit" name="bank_soal_id" class="form-control" required>
							@foreach ($bankSoals as $bankSoal)
								<option value="{{ $bankSoal->id }}">{{ $bankSoal->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="tes-name-edit">Name</label>
						<input type="text" name="name" id="tes-name-edit" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="tes-waktupengerjaan-edit">Waktu Pengerjaan</label>
						<div class="form-row">
							<div class="col-3">
								<input type="number" name="waktu_pengerjaan" id="tes-waktupengerjaan-edit" class="form-control" required>
							</div>
							<div class="col-1 align-items-center">
								<span class="text-center">Menit</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="tes-total-soal-edit">Total Soal</label>
						<input type="number" name="total_soal" id="tes-total-soal-edit" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="tes-keterangan-edit">Keterangan</label>
						<textarea name="keterangan" id="tes-keterangan-edit" class="form-control" required></textarea>
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
		$(document).ready(function() {
			$("#tes-banksoal-edit").select2();
		});

		function edit(id) {
			$.getJSON(`{{ url('guru/modul/' . $modul->id) }}/tes/${id}`, data => {
				$("#form-edit-modul").attr('action', `{{ url('guru/modul/' . $modul->id) }}/tes/${id}`);
				$("#tes-banksoal-edit").val(data.bank_soal_id);
				$("#tes-name-edit").val(data.name);
				$("#tes-waktupengerjaan-edit").val(data.waktu_pengerjaan);
				$("#tes-keterangan-edit").val(data.keterangan);
				$("#tes-total-soal-edit").val(data.total_soal);

				$("#modal-edit-tes").modal();
			});
		}
	</script>
@endpush