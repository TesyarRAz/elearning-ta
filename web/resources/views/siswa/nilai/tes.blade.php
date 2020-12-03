@extends('siswa.layout')

@section('content')
	<div class="my-3">
		<h4 class="lead mb-2">Daftar Nilai Anda</h4>
		<hr>

		<table class="text-center table table-sm table-responsive-sm table-bordered">
			<thead>
				<tr>
					<th rowspan="2">No</th>
					<th rowspan="2">Nama Modul</th>
					<th rowspan="2">Nama Tes</th>
					<th colspan="4">Nilai</th>
					<th rowspan="2">Tanggal</th>
				</tr>
				<tr>
					<th>Nilai</th>
					<th>Benar</th>
					<th>Salah</th>
					<th>Total Soal</th>
				</tr>
			</thead>
			<tbody>
				@foreach($siswa_tesses as $t)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $t->tes->modul->name }}</td>
						<td>{{ $t->tes->name }} </td>
						<td>{{ $t->nilai }}</td>
						<td>{{ $t->benar }}</td>
						<td>{{ $t->salah }}</td>
						<td>{{ $t->tes->total_soal }}</td>
						<td>{{ $t->created_at->format('Y-m-d') }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection