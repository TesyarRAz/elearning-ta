<form action="{{ route('guru.soal.store', [$bankSoal->id])}}" method="POST">
	@csrf

	<div class="modal fade" id="modal-create-soal">
		<div class="modal-dialog" style="min-width: 80%">
			<div class="modal-content">
				<div class="modal-header">
					<span class="modal-title">Tambah Soal</span>
					<button class="close" data-dismiss="modal">X</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="soal-soal-create">Soal</label>
						<textarea name="soal" id="soal-soal-create" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label for="soal-pilihan-create">Pilihan</label>
						<table id="soal-pilihan-create" class="table table-responsive-sm table-bordered">
							<thead>
								<tr>
									<th>Pilihan</th>
									<th>Benar</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(pilihan, index) in pilihans" :key="index">
									<td>
										<input type="text" :name="`pilihans[${index}][pilihan]`" class="form-control">
									</td>
									<td>
										<input type="checkbox" :name="`pilihans[${index}][benar]`" class="form-check">
									</td>
								</tr>
								<tr>
									<td width="80%"></td>
									<td>
										<button class="btn btn-sm btn-outline-success" type="button" v-on:click="addPilihan()">Tambah</button>
									</td>
								</tr>
							</tbody>
						</table>
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
			
			
			new Vue({
				el: '#soal-pilihan-create',
				data: () => ({
					pilihans: []
				}),
				methods: {
					addPilihan() {
						this.pilihans.push({
							'pilihan': '',
							'benar': false
						});
					}
				}
			})
		});
	</script>
@endpush