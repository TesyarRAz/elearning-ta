<form method="POST" id="form-edit-soal">
	@csrf
	@method('PUT')

	<div class="modal fade" id="modal-edit-soal">
		<div class="modal-dialog" style="min-width: 80%">
			<div class="modal-content">
				<div class="modal-header">
					<span class="modal-title">Edit Soal</span>
					<button class="close" data-dismiss="modal">X</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="soal-soal-edit">Soal</label>
						<textarea name="soal" id="soal-soal-edit" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label for="soal-pilihan-edit">Pilihan</label>
						<table id="soal-pilihan-edit" class="table table-responsive-sm table-bordered">
							<thead>
								<tr>
									<th>Pilihan</th>
									<th>Benar</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(pilihan, index) in pilihans" :key="index">
									<td>
										<input type="hidden" :name="`pilihans[${index}][id]`" :value="pilihan.id">
										<input type="text" :name="`pilihans[${index}][pilihan]`" class="form-control" v-model="pilihan.pilihan">
									</td>
									<td>
										<input type="checkbox" :name="`pilihans[${index}][benar]`" v-model="pilihan.benar" class="form-check">
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
			let editorSoal = CKEDITOR.replace(document.querySelector("#soal-soal-edit"), {
				filebrowserUploadUrl: "{{route('post.upload', ['_token' => csrf_token() ])}}",
        		filebrowserUploadMethod: 'form'
			});

			var vueCallback;

			new Vue({
				el: '#soal-pilihan-edit',
				data: () => ({
					pilihans: []
				}),
				mounted() {
					vueCallback = (soal) => {
						this.pilihans = soal.pilihans;	
					};
				},
				methods: {
					addPilihan() {
						this.pilihans.push({
							'pilihan': '',
							'benar': false
						});
					}
				}
			});

			window.edit = function(id) {
				$.getJSON(`{{ url('guru/banksoal/' . $bankSoal->id) }}/soal/${id}`, data => {
					$("#form-edit-soal").attr('action', `{{ url('guru/banksoal/' . $bankSoal->id) }}/soal/${id}`);

					editorSoal.setData(data.soal);

					vueCallback(data);

					$("#modal-edit-soal").modal();
				});
			}
		});
	</script>
@endpush