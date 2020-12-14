<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Modul;
use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function data(Modul $modul)
    {

        return datatables($modul->materis()->select('id', 'name', 'created_at'))->toJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Modul $modul)
    {
        return view('guru.materi.index', compact('modul'));
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
            'keterangan' => 'required',
            'gambar' => 'file|image',
        ]);

        $modul->materis()->create($data);

        return back()->withStatus('Berhasil tambah materi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function show(Modul $modul, Materi $materi)
    {
        return response($materi);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function edit(Materi $materi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modul $modul, Materi $materi)
    {
        $data = $request->validate([
            'name' => 'required',
            'keterangan' => 'required',
            'gambar' => 'file|image',
        ]);

        $materi->update($data);

        return back()->withStatus('Berhasil edit materi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modul $modul, Materi $materi)
    {
        try {
            $materi->delete();
        } catch (\Exception $e) {
            return back()->withStatus('Materi sudah digunakan tidak bisa dihapus');
        }

        return back()->withStatus('Berhasil hapus materi');
    }
}
