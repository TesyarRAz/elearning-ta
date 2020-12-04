@extends('adminlte::page')

@section('content_header')
	<ul class="breadcrumb">
		<li class="breadcrumb-item">Kelola Pembelajaran</li>
		<li class="breadcrumb-item">Kelola Modul</li>
	</ul>
@endsection

@section('content')
	@include('guru.modul.create')
	@include('guru.modul.edit')
	@include('partials.status')

	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Daftar Modul</h4>
			<div class="card-tools">
				<button data-toggle="modal" data-target="#modal-create-modul" class="btn btn-sm btn-outline-primary">
					<i class="fas fa-plus"></i>
					Tambah
				</button>
			</div>
		</div>

		<div class="card-body">
			<table id="table" class="table table-bordered table-responsive-sm">
				<thead>
					<tr>
						<th>Nama Modul</th>
						<th>Kelas</th>
						<th>Tanggal Dibuat</th>
						<th>Password</th>
						<th>Aksi</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
@endsection

@push('js')
	<script type="text/javascript">
		CKEDITOR.config.removePlugins = 'html5video';

		var pelajarans = @json($pelajarans);

		$(document).ready(function() {
			$("#table").DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: '{{ route('guru.modul.data') }}',
					type: 'POST',
					data: data => {
						data['_token'] = $("meta[name=csrf-token]").attr('content')
					}
				},
				deferRender: true,
				columns: [
					{ data: 'name' },
					{ data: 'kelas' },
					{ data: 'created_at' },
					{ data: 'password', render: (data, type, row) => {
						return data == null ? "Tidak ada password" : data;
					}},
					{ data: 'id', render: (data, type, row) => (
						`
							<div class="dropdown">
								<div class="btn-group">
									<button onclick="edit(${data})" type="button" class="btn btn-sm btn-outline-primary">Edit</button>

									<button onclick="$('#form-delete-${data}').submit()" type="button" class="btn btn-sm btn-outline-danger">Hapus</button>

									<button class="btn btn-sm btn-outline-info" type="button" data-toggle="dropdown">
										Setup
									</button>

									<div class="dropdown-menu">
										<a class="dropdown-item" href="{{ url('guru/modul') }}/${data}/materi">Materi</a>
										<a class="dropdown-item" href="{{ url('guru/modul') }}/${data}/tes">Tes</a>
										<a class="dropdown-item" href="{{ url('guru/modul') }}/${data}/quiz">Quiz</a>
									</div>
								</div>

								<form id="form-delete-${data}" action="{{ url('guru/modul') }}/${data}" method="POST" onsubmit="return confirm('Yakin ingin dihapus')">
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