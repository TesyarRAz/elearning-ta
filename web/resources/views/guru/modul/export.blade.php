<table>
    <thead>
    	<tr>
    		<th rowspan="2">No</th>
    		<th rowspan="2">Nama Siswa</th>
    		<th colspan="{{ $modul->tesses()->count() }}">
    			Tes
    		</th>
            <th colspan="{{ $modul->quizes()->count() }}">
                Quiz
            </th>
    	</tr>
    	<tr>
    		@forelse ($modul->tesses as $t)
    			<th>{{ $t->name }}</th>

                @empty
                <th></th>
    		@endforelse
            @forelse ($modul->quizes as $t)
                <th>{{ $t->created_at }}</th>
                @empty
                <th></th>
            @endforelse
    	</tr>
    </thead>
    <tbody>
        @php($relation = $modul->tesses()->count() > $modul->quizes()->count() ? $modul->siswatesses() : $modul->siswaquizes())
        @php($relation->with('siswa'))
    	@forelse($relation->get() as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->siswa->name }}</td>
                @forelse($modul->tesses as $t)
                    @php($st = $modul->siswatesses()->whereTesId($t->id)->whereSiswaId($d->id)->first())
                    @if(empty($st))
                        <td></td>
                        @else
                        <td>{{ $st->nilai }}</td>
                    @endif

                    @empty
                    <td></td>
                @endforelse

                @forelse($modul->quizes as $t)
                    @php($st = $modul->siswaquizes()->whereQuizId($t->id)->whereSiswaId($d->id)->first())
                    @if(empty($st))
                        <td></td>
                        @else
                        <td>{{ $st->nilai }}</td>
                    @endif

                    @empty
                    <td></td>
                @endforelse
            </tr>
            @empty
                <tr>
                    <td colspan="4" align="center">Tidak Ada Data</td>
                </tr>
        @endforelse
    </tbody>
</table>