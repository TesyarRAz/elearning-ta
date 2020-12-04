@extends('adminlte::page')

@section('content_header')
	<ul class="breadcrumb">
		<li class="breadcrumb-item">Kelola Nilai</li>
		<li class="breadcrumb-item">Kelola Nilai Quiz</li>
	</ul>
@endsection

@section('content')
	<div class="modal fade" id="modal-show-quiz">
		<div class="modal-dialog" style="min-width: 80%">
			<div class="modal-content">
				<div class="modal-header">
					<span class="modal-title">Soal</span>
					<button class="close" data-dismiss="modal">X</button>
				</div>
				<div class="modal-body">
					<div class="form-group" id="modal-soal"></div>
					<hr>
					<div class="form-group" id="modal-jawab"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>

	<form class="modal fade" id="modal-nilai" method="POST">
		@csrf

		<div class="modal-dialog" style="min-width: 80%">
			<div class="modal-content">
				<div class="modal-header">
					<span class="modal-title">Soal</span>
					<button class="close" data-dismiss="modal">X</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Nilai</label>
						<input type="number" name="nilai" class="form-control" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-outline-primary">Nilai</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</form>

	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Daftar Nilai Quiz</h4>
		</div>

		<div class="card-body">
			<table id="table" class="table table-bordered table-responsive-sm">
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>Nama Siswa</th>
						<th>Modul</th>
						<th>Lihat</th>
						<th>Nilai</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<body>
					@foreach($data as $d)
						<tr>
							<td>{{ $d->created_at }}</td>
							<td>{{ $d->siswa->name }}</td>
							<td>{{ $d->quiz->modul->name }}</td>
							<td>
								<button onclick="show({{ $d->id }})" class="btn btn-sm btn-outline-primary">
									Detail
								</button>
							</td>
							<td>
								@if($d->dinilai)
									<span>{{ $d->nilai }}</span>
									@else
										Belum dinilai
								@endif
							</td>
							<td>
								<button onclick="nilai({{ $d->id }})" class="btn btn-sm btn-outline-primary @if($d->dinilai) disabled @endif">
									Beri Nilai
								</button>
							</td>
						</tr>
					@endforeach
				</body>
			</table>

			{{ $data->links() }}
		</div>
	</div>
@endsection

@push('js')
	<script type="text/javascript" src="{{ asset('assets/js/dayjs.min.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			window.show = function(id) {
				$('#modal-soal').load('{{ url('guru/nilai/quiz') }}/' + id + "?soal=true");
				$('#modal-jawab').load('{{ url('guru/nilai/quiz') }}/' + id + "?jawab=true");
				$("#modal-show-quiz").modal();
			}

			window.nilai = function(id) {
				$("#modal-nilai").attr('action', '{{ url('guru/nilai/quiz') }}/' + id);
				$("#modal-nilai").modal();
			}
		});
	</script>
@endpush