@extends('adminlte::page')

@section('content_header')
	<ul class="breadcrumb">
		<li class="breadcrumb-item">Kelola Pembelajaran</li>
		<li class="breadcrumb-item">
			<a class="breadcrumb-link" href="{{ route('guru.modul.index') }}">Kelola Modul</a>
		</li>
		<li class="breadcrumb-item">Kelola Quiz</li>
	</ul>
@endsection

@section('content')
	@include('partials.status')
	@include('guru.quiz.create')
	@include('guru.quiz.edit')

	<div class="modal fade" id="modal-show-quiz">
		<div class="modal-dialog" style="min-width: 80%">
			<div class="modal-content">
				<div class="modal-header">
					<span class="modal-title">Soal</span>
					<button class="close" data-dismiss="modal">X</button>
				</div>
				<div class="modal-body" id="modal-show-body">
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Daftar Quiz</h4>
			<div class="card-tools">
				<button data-toggle="modal" data-target="#modal-create-quiz" class="btn btn-sm btn-outline-primary">
					<i class="fas fa-plus"></i>
					Tambah
				</button>
			</div>
		</div>

		<div class="card-body">
			<table id="table" class="table table-bordered table-responsive-sm">
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>Soal</th>
						<th>Aksi</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
@endsection

@push('js')
	<script type="text/javascript" src="{{ asset('assets/js/dayjs.min.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			window.show = function(id) {
				$('#modal-show-body').load('{{ url('guru/modul/' . $modul->id . '/quiz') }}/' + id + "?soal=true");
				$("#modal-show-quiz").modal();
			}

			$("#table").DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: '{{ route('guru.quiz.data', [$modul->id]) }}',
					type: 'POST',
					data: data => {
						data['_token'] = $("meta[name=csrf-token]").attr('content')
					}
				},
				deferRender: true,
				columns: [
					{ data: 'created_at' },
					{ data: 'id', render: (data, type, row) => (
						`
							<button class="btn btn-sm btn-outline-primary" onclick="show(${data})">
								Detail
							</button>
						`
					)},
					{ data: 'id', render: (data, type, row) => (
						`
							<div class="dropdown">
								<div class="btn-group">
									<button onclick="edit(${data})" type="button" class="btn btn-sm btn-outline-primary">Edit</button>

									<button onclick="$('#form-delete-${data}').submit()" type="button" class="btn btn-sm btn-outline-danger">Hapus</button>
								</div>

								<form id="form-delete-${data}" action="{{ url('guru/modul/' . $modul->id) }}/quiz/${data}" method="POST" onsubmit="return confirm('Yakin ingin dihapus')">
									@csrf
									@method('DELETE')
								</form>
							</div>
						`
					)}
				]
			});
		});
	</script>
@endpush