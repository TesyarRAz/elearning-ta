@extends('adminlte::page')

@section('content_header')
	<ul class="breadcrumb">
		<li class="breadcrumb-item">Kelola Pembelajaran</li>
		<li class="breadcrumb-item">Kelola Pelajaran</li>
	</ul>
@endsection

@section('content')
	@include('admin.pelajaran.create')
	@include('admin.pelajaran.edit')
	@include('partials.status')

	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Daftar Pelajaran</h4>
			<div class="card-tools">
				<button data-toggle="modal" data-target="#modal-create-pelajaran" class="btn btn-sm btn-outline-primary">
					<i class="fas fa-plus"></i>
					Tambah
				</button>
			</div>
		</div>

		<div class="card-body">
			<table id="table" class="table table-bordered table-responsive-sm">
				<thead>
					<tr>
						<th>Nama Pelajaran</th>
						<th>Total Modul</th>
						<th>Aksi</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
@endsection

@section('js')
	<script type="text/javascript">
		$(document).ready(function() {
			$("#table").DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: '{{ route('admin.pelajaran.data') }}',
					type: 'POST',
					data: data => {
						data['_token'] = $("meta[name=csrf-token]").attr('content')
					}
				},
				deferRender: true,
				columns: [
					{ data: 'name' },
					{ data: 'moduls_count' },
					{ data: 'id', render: (data, type, row) => (
						`
							<div class="btn-group">
								<button onclick="edit(${data})" type="button" class="btn btn-sm btn-outline-primary">Edit</button>

								<button onclick="$('#form-delete-${data}').submit()" type="button" class="btn btn-sm btn-outline-danger">Hapus</button>

								<form id="form-delete-${data}" action="{{ url('admin/pelajaran') }}/${data}" method="POST" onsubmit="return confirm('Yakin ingin dihapus')">
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
@endsection