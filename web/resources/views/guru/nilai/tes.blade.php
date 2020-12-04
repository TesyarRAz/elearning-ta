@extends('adminlte::page')

@section('content_header')
	<ul class="breadcrumb">
		<li class="breadcrumb-item">Kelola Nilai</li>
		<li class="breadcrumb-item">Kelola Nilai Tes</li>
	</ul>
@endsection

@section('content')
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Daftar Nilai Tes</h4>
		</div>

		<div class="card-body">
			<table id="table" class="table table-bordered table-responsive-sm">
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>Nama Siswa</th>
						<th>Modul</th>
						<th>Tes</th>
						<th>Nilai</th>
					</tr>
				</thead>
				<body>
					@foreach($data as $d)
						<tr>
							<td>{{ $d->created_at }}</td>
							<td>{{ $d->siswa->name }}</td>
							<td>{{ $d->tes->modul->name }}</td>
							<td>{{ $d->tes->name }}</td>
							<td>{{ $d->nilai }}</td>
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
@endpush