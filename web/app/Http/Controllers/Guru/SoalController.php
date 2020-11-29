<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\BankSoal;
use App\Models\Soal;
use App\Models\Pilihan;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    public function data(BankSoal $bankSoal)
    {
        return datatables($bankSoal->soals())->toJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BankSoal $bankSoal)
    {
        return view('guru.banksoal.soal.index', compact('bankSoal'));
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
    public function store(Request $request, BankSoal $bankSoal)
    {
        $data = $request->validate([
            'soal' => 'required',
            'pilihans' => 'required|array'
        ]);

        $soal = $bankSoal->soals()->create([
            'soal' => $data['soal']
        ]);

        $pilihans = [];

        foreach ($data['pilihans'] as $d)
        {
            $benar = ($d['benar'] ?? 'off') == 'on' ? true : false;
            $pilihan = $d['pilihan'];

            if (!empty($pilihan))
            {
                $pilihans[] = compact('pilihan', 'benar');
            }
        }

        $soal->pilihans()->createMany($pilihans);

        return back()->withStatus('Berhasil tambah soal');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function show(BankSoal $bankSoal, Soal $soal)
    {
        return response($soal->load('pilihans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function edit(Soal $soal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankSoal $bankSoal, Soal $soal)
    {
        $data = $request->validate([
            'soal' => 'required',
            'pilihans' => 'required|array'
        ]);

        $soal->update([
            'soal' => $data['soal']
        ]);

        $pilihans = [];
        $newPilihans = [];

        foreach ($data['pilihans'] as $d)
        {
            $id = $d['id'];
            $benar = ($d['benar'] ?? 'off') == 'on' ? true : false;
            $pilihan = $d['pilihan'];

            if (!empty($pilihan))
            {
                if (!empty($id))
                {
                    $pilihans[$id] = compact('pilihan', 'benar');
                }
                else
                {
                    $newPilihans[] = with(new Pilihan)->fill(
                        compact('pilihan', 'benar')
                    );
                }
            }
        }

        [ $accepted, $removed ] = $soal->pilihans->partition(fn($pilihan) => array_key_exists($pilihan->id, $pilihans));

        if (count($removed) > 0)
        {
            $soal->pilihans()->delete($removed);
        }

        foreach ($accepted as $pilihan)
        {
            $pilihan->update($pilihans[$pilihan->id]);
        }

        $soal->pilihans()->saveMany($newPilihans);

        return back()->withStatus('Berhasil edit soal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankSoal $bankSoal, Soal $soal)
    {
        $soal->pilihans()->delete();
        $soal->delete();

        return back()->withStatus('Berhasil hapus soal');
    }
}
