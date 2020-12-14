<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\BankSoal;
use App\Models\Pelajaran;
use Illuminate\Http\Request;

class BankSoalController extends Controller
{
    public function data()
    {
        return datatables(auth()->user()->guru->bankSoals()->withCount('soals'))->toJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelajarans = Pelajaran::latest()->get();

        return view('guru.banksoal.index', compact('pelajarans'));
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
        $data = $request->validate([
            'name' => 'required',
            'keterangan' => 'required',
            'gambar' => 'file|image',
            'pelajaran_id' => 'required|exists:pelajarans,id'
        ]);

        auth()->user()->guru->bankSoals()->create($data);

        return back()->withStatus('Berhasil tambah bank soal');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankSoal  $bankSoal
     * @return \Illuminate\Http\Response
     */
    public function show(BankSoal $bankSoal)
    {
        return response($bankSoal);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankSoal  $bankSoal
     * @return \Illuminate\Http\Response
     */
    public function edit(BankSoal $bankSoal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankSoal  $bankSoal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankSoal $bankSoal)
    {
        $data = $request->validate([
            'name' => 'required',
            'keterangan' => 'required',
            'gambar' => 'file|image',
            'pelajaran_id' => 'required|exists:pelajarans,id'
        ]);

        $bankSoal->update($data);

        return back()->withStatus('Berhasil tambah bank soal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankSoal  $bankSoal
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankSoal $bankSoal)
    {
        try {
            $banksoal->soals()->delete();
            $bankSoal->delete();
        } catch (\Exception $e) {
            return back()->withStatus('BankSoal sudah digunakan tidak bisa dihapus');
        }

        return back()->withStatus('Berhasil hapus bank soal');
    }
}
