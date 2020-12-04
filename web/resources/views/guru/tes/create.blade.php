<form action="{{ route('guru.tes.store', [$modul->id])}}" method="POST">
	@csrf

	<div class="modal fade" id="modal-create-tes">
		<div class="modal-dialog" style="min-width: 80%">
			<div class="modal-content">
				<div class="modal-header">
					<span class="modal-title">Tambah tes</span>
					<button class="close" data-dismiss="modal">X</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="tes-banksoal-create">Bank Soal</label>
						<select id="tes-banksoal-create" name="bank_soal_id" class="form-control" required>
							@foreach ($bankSoals as $bankSoal)
								<option value="{{ $bankSoal->id }}">{{ $bankSoal->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="tes-name-create">Name</label>
						<input type="text" name="name" id="tes-name-create" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="tes-waktupengerjaan-create">Waktu Pengerjaan</label>
						<div class="form-row">
							<div class="col-3">
								<input type="number" name="waktu_pengerjaan" id="tes-waktupengerjaan-create" class="form-control" required>
							</div>
							<div class="col-1 align-items-center">
								<span class="text-center">Menit</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="tes-total-soal-create">Total Soal</label>
						<input type="number" name="total_soal" id="tes-total-soal-create" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="tes-keterangan-create">Keterangan</label>
						<textarea name="keterangan" id="tes-keterangan-create" class="form-control" required></textarea>
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
			$("#tes-banksoal-create").select2();
		});
	</script>
@endpush