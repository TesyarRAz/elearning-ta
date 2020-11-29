<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tes;
use App\Models\Modul;
use App\Models\Soal;
use App\Models\SiswaTes;
use App\Models\SiswaTesPilihan;
use Illuminate\Http\Request;

class TesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Modul $modul)
    {
        return response([
            'data' => $modul->tesses()->with('banksoal')->latest()->paginate(10)
        ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tes  $tes
     * @return \Illuminate\Http\Response
     */
    public function show(Modul $modul, Tes $tes)
    {
        return response([
            'data' => $tes->with('banksoal')->with('banksoal.soals')->with('banksoal.soals.pilihans')->paginate(1)
        ]);
    }

    public function join(Request $request, Modul $modul, Tes $tes)
    {
        
    }

    public function jawab(Request $request, Modul $modul, Tes $tes)
    {
        $request->validate([
            'jawaban' => 'required|array',
            'sisa_waktu' => 'required|numeric'
        ]);

        /* 
        * Ada bug disini, jika user iseng nge cheat jawaban yg dikasih user melibihi yang harus
        * dijawab nilainya bisa 100 lebih dong :'v
        * Harus dioptimisasi querynya wahai aku dimasa depan
        * Yap, ini cara paling cepat, jadi bisa di hack dengan mudah percayalah, broh
        */
        if (SiswaTes::whereTesId($tes->id)->whereSiswaId(auth()->user()->siswa->id)->exists())
        {
            $siswa_tes = SiswaTes::whereTesId($tes->id)->whereSiswaId(auth()->user()->siswa->id)->first();
            $siswa_tes->pilihans()->delete();
            $siswa_tes->delete();
        }

        $siswa_tes = new SiswaTes;
        
        $siswa_tes->benar = 0;
        $siswa_tes->salah = 0;
        $siswa_tes->tes_id = $tes->id;
        $siswa_tes->sisa_waktu = \Carbon\Carbon::createFromFormat('i', $request->sisa_waktu)->format('H:i:s');

        $result_jawaban = [];
        foreach ($request->jawaban as $jawab)
        {
            [ 'soal_id' => $soal_id, 'pilihan_id' => $pilihan_id ] = $jawab;

            $benar = $tes->banksoal->soals()->find($soal_id)->pilihans()->whereKey($pilihan_id)->value('benar') ?? 0;

            $result_jawaban[] = new SiswaTesPilihan(
                compact('soal_id', 'pilihan_id', 'benar')
            );

            $siswa_tes->benar += $benar ? 1 : 0;
            $siswa_tes->salah += $benar ? 0 : 1;
        }

        $siswa_tes->nilai = (100 / $tes->total_soal) * $siswa_tes->benar;

        auth()->user()->siswa->tesses()->save($siswa_tes);
        $siswa_tes->pilihans()->saveMany($result_jawaban);

        return response([
            'data' => $siswa_tes
        ]);
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
    public function update(Request $request, Tes $tes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tes  $tes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tes $tes)
    {
        //
    }
}
