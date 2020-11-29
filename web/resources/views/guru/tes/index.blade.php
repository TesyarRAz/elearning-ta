@extends('adminlte::page')

@section('content_header')
	<ul class="breadcrumb">
		<li class="breadcrumb-item">Kelola Pembelajaran</li>
		<li class="breadcrumb-item">
			<a class="breadcrumb-link" href="{{ route('guru.modul.index') }}">Kelola Modul</a>
		</li>
		<li class="breadcrumb-item">Kelola Tes</li>
	</ul>
@endsection

@section('content')
	@include('guru.tes.create')
	@include('guru.tes.edit')
	@include('partials.status')

	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Daftar Tes</h4>
			<div class="card-tools">
				<button data-toggle="modal" data-target="#modal-create-tes" class="btn btn-sm btn-outline-primary">
					<i class="fas fa-plus"></i>
					Tambah
				</button>
			</div>
		</div>

		<div class="card-body">
			<table id="table" class="table table-bordered table-responsive-sm">
				<thead>
					<tr>
						<th>Nama Tes</th>
						<th>Waktu Pengerjaan</th>
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
			$("#table").DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: '{{ route('guru.tes.data', [$modul->id]) }}',
					type: 'POST',
					data: data => {
						data['_token'] = $("meta[name=csrf-token]").attr('content')
					}
				},
				deferRender: true,
				columns: [
					{ data: 'name' },
					{ data: 'waktu_pengerjaan', render: (data, type, row) => data + " Menit" },
					{ data: 'id', render: (data, type, row) => (
						`
							<div class="dropdown">
								<div class="btn-group">
									<button onclick="edit(${data})" type="button" class="btn btn-sm btn-outline-primary">Edit</button>

									<button onclick="$('#form-delete-${data}').submit()" type="button" class="btn btn-sm btn-outline-danger">Hapus</button>
								</div>

								<form id="form-delete-${data}" action="{{ url('guru/modul/' . $modul->id) }}/tes/${data}" method="POST" onsubmit="return confirm('Yakin ingin dihapus')">
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