@extends('adminlte::page')

@section('content_header')
	<ul class="breadcrumb">
		<li class="breadcrumb-item">Kelola Pembelajaran</li>
		<li class="breadcrumb-item">
			<a class="breadcrumb-link" href="{{ route('guru.banksoal.index') }}">Kelola Bank Soal</a>
		</li>
		<li class="breadcrumb-item">Kelola Soal</li>
	</ul>
@endsection

@section('content')
	@include('guru.banksoal.soal.create')
	@include('guru.banksoal.soal.edit')
	@include('partials.status')

	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Daftar Soal</h4>
			<div class="card-tools">
				<button data-toggle="modal" data-target="#modal-create-soal" class="btn btn-sm btn-outline-primary">
					<i class="fas fa-plus"></i>
					Tambah
				</button>
			</div>
		</div>

		<div class="card-body">
			<table id="table" class="table table-bordered table-responsive-sm">
				<thead>
					<tr>
						<th>Soal</th>
						<th>Aksi</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
@endsection

@push('js')
	<script type="text/javascript" src="{{ asset('assets/js/vue@2.6.12.min.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#table").DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: '{{ route('guru.soal.data', [$bankSoal->id]) }}',
					type: 'POST',
					data: data => {
						data['_token'] = $("meta[name=csrf-token]").attr('content')
					}
				},
				deferRender: true,
				columns: [
					{ data: 'soal' },
					{ data: 'id', render: (data, type, row) => (
						`
							<div class="dropdown">
								<div class="btn-group">
									<button onclick="edit(${data})" type="button" class="btn btn-sm btn-outline-primary">Edit</button>

									<button onclick="$('#form-delete-${data}').submit()" type="button" class="btn btn-sm btn-outline-danger">Hapus</button>
								</div>

								<form id="form-delete-${data}" action="{{ url('guru/banksoal/' . $bankSoal->id) }}/soal/${data}" method="POST" onsubmit="return confirm('Yakin ingin dihapus')">
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