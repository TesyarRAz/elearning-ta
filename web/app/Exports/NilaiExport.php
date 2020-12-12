<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use App\Models\Modul;

class NilaiExport implements FromView
{
	private Modul $modul;

	public function __construct(Modul $modul)
	{
		$this->modul = $modul;
	}

    public function view(): View
    {
    	$modul = $this->modul;

        return view('guru.modul.export', compact('modul'));
    }
}
