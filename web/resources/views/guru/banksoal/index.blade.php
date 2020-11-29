@extends('adminlte::page')

@section('content_header')
	<ul class="breadcrumb">
		<li class="breadcrumb-item">Kelola Pembelajaran</li>
		<li class="breadcrumb-item">Kelola Bank Soal</li>
	</ul>
@endsection

@section('content')
	@include('guru.banksoal.create')
	@include('guru.banksoal.edit')
	@include('partials.status')

	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Daftar Bank Soal</h4>
			<div class="card-tools">
				<button data-toggle="modal" data-target="#modal-create-banksoal" class="btn btn-sm btn-outline-primary">
					<i class="fas fa-plus"></i>
					Tambah
				</button>
			</div>
		</div>

		<div class="card-body">
			<table id="table" class="table table-bordered table-responsive-sm">
				<thead>
					<tr>
						<th>Nama Bank Soal</th>
						<th>Total Soal</th>
						<th>Aksi</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
@endsection

@push('js')
	<script type="text/javascript">
		$(document).ready(function() {
			$("#table").DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: '{{ route('guru.banksoal.data') }}',
					type: 'POST',
					data: data => {
						data['_token'] = $("meta[name=csrf-token]").attr('content')
					}
				},
				deferRender: true,
				columns: [
					{ data: 'name' },
					{ data: 'soals_count' },
					{ data: 'id', render: (data, type, row) => (
						`
							<div class="btn-group">
								<button onclick="edit(${data})" type="button" class="btn btn-sm btn-outline-primary">Edit</button>

								<button onclick="$('#form-delete-${data}').submit()" type="button" class="btn btn-sm btn-outline-danger">Hapus</button>

								<a href="{{ url('guru/banksoal/') }}/${data}/soal" class="btn btn-sm btn-outline-info">
									Daftar Soal
								</a>
							</div>

							<form id="form-delete-${data}" action="{{ url('guru/banksoal') }}/${data}" method="POST" onsubmit="return confirm('Yakin ingin dihapus')">
								@csrf
								@method('DELETE')
							</form>
						`
					)}
				]
			});
		});
	</script>
@endpush