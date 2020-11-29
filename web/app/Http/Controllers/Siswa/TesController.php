<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Modul;
use App\Models\Soal;
use App\Models\Tes;
use App\Models\SiswaTes;
use App\Models\SiswaTesPilihan;
use Illuminate\Http\Request;

use Carbon\Carbon;

class TesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Modul $modul)
    {
        $tesses = $modul->tesses()->paginate(10);

        return view('siswa.tes.index', compact('modul', 'tesses'));
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
    public function store(Request $request, Tes $tes)
    {
        $siswa_tes = auth()->user()->siswa
        ->tesses()
        ->create([
            'tes_id' => $tes->id,
            'sisa_waktu' => now()->addMinute($tes->waktu_pengerjaan)->format('H:i:s'),
            'nilai' => 0,
            'benar' => 0,
            'salah' => 0
        ]);

        $siswa_tes->pilihans()->insertUsing(
            ['soal_id', 'siswa_tes_id'],

            $tes->banksoal
            ->soals()
            ->inRandomOrder()
            ->select('id as soal_id')
            ->selectSub((string) $siswa_tes->id, 'siswa_tes_id')
            ->take($tes->total_soal)
        );

        auth()->user()->state()->update([
            'state' => 'sedang_tes',
            'values' => $siswa_tes->id
        ]);

        return redirect()->route('siswa.tes.edit', [$tes->id, $siswa_tes->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tes  $tes
     * @return \Illuminate\Http\Response
     */
    public function show(Tes $tes)
    {
        $tes->banksoal->with('soals');
        $tes->banksoal->soals->load('pilihans');

        return view('siswa.tes.show', compact('tes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tes  $tes
     * @return \Illuminate\Http\Response
     */
    public function edit(Tes $tes, SiswaTes $siswa_tes)
    {
        $data = $tes->banksoal->soals()->with('pilihans')->paginate(1);

        abort_if($data->isEmpty(), 404);

        $soal = $data->first();

        if ($siswa_tes->sisa_waktu->lte(now()))
        {
            return redirect()->route('siswa.tes.selesai', compact('tes', 'siswa_tes'));
        }

        return view('siswa.tes.edit', compact('tes', 'data', 'soal', 'siswa_tes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tes  $tes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tes $tes, SiswaTes $siswa_tes)
    {
        $data = $request->validate([
            'soal_id' => 'required|exists:soals,id',
            'pilihan_id' => 'required|exists:pilihans,id',
        ]);

        // $benar = false;
        // $pilihans = Soal::findOrFail($data['soal_id'])->pilihans;
        // foreach ($pilihans as $p)
        // {
        //     if ($p->benar && $p->id == $data['pilihan_id'])
        //     {
        //         $benar = true;
        //     }
        // }

        // Mengecek apakah yang diinputkan benar atau salah
        $benar = Soal::findOrFail($data['soal_id'])
        ->pilihans()
        ->whereKey($data['pilihan_id'])
        ->value('benar');

        $siswa_tes->pilihans()->whereSoalId($data['soal_id'])
        ->update([
            'pilihan_id' => $data['pilihan_id'],
            'benar' => $benar
        ]);

        return response(['code' => 1]);
    }

    public function selesai(Request $request, Tes $tes, SiswaTes $siswa_tes)
    {
        $benar = $siswa_tes->pilihans()->whereBenar(true)->count();

        $nilai = (100 / $tes->total_soal) * $benar;

        $siswa_tes->update([
            'selesai' => true,
            'benar' => $benar,
            'nilai' => $nilai,
            'salah' => $tes->total_soal - $benar
        ]);

        auth()->user()->state()->update(['state' => 'initial', 'values' => null]);

        return redirect()->route('home')
        ->withStatus('Anda telah mengerjakan soal, Nilai ' . $nilai);
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
