<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Modul;
use App\Models\Tes;
use Illuminate\Http\Request;

class TesController extends Controller
{
    public function data(Modul $modul)
    {
        return datatables($modul->tesses())->toJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Modul $modul)
    {
        $bankSoals = auth()->user()->guru->bankSoals;

        return view('guru.tes.index', compact('modul', 'bankSoals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Modul $modul)
    {
        $data = $request->validate([
            'name' => 'required',
            'bank_soal_id' => 'required|exists:bank_soals,id',
            'waktu_pengerjaan' => 'required|numeric',
            'total_soal' => 'required|numeric',
            'keterangan' => 'required'
        ]);

        $modul->tesses()->create($data);

        return back()->withStatus('Berhasil menambahkan tes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tes  $tes
     * @return \Illuminate\Http\Response
     */
    public function show(Modul $modul, Tes $tes)
    {
        return response($tes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tes  $tes
     * @return \Illuminate\Http\Response
     */
    public function edit(Tes $tes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tes  $tes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modul $modul, Tes $tes)
    {
        $data = $request->validate([
            'name' => 'required',
            'bank_soal_id' => 'required|exists:bank_soals,id',
            'waktu_pengerjaan' => 'required|numeric',
            'total_soal' => 'required|numeric',
            'keterangan' => 'required'
        ]);

        $tes->update($data);

        return back()->withStatus('Berhasil edit tes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tes  $tes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modul $modul, Tes $tes)
    {
        $tes->delete();

        return back()->withStatus('Berhasil hapus tes');
    }
}
