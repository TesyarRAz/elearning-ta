<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Modul;
use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Modul $modul)
    {
        $materis = $modul->materis()->paginate(10);

        return view('siswa.materi.index', compact('modul', 'materis'));
    }

    public function mark(Materi $materi)
    {
        auth()->user()->siswa->materi()->updateOrCreate([
            'materi_id' => $materi->id,
        ], [
            'marked' => true
        ]);

        return back()->withStatus('Berhasil mark materi');
    }

    public function unmark(Materi $materi)
    {
        auth()->user()->siswa->materi()->updateOrCreate([
            'materi_id' => $materi->id,
        ], [
            'marked' => false
        ]);

        return back()->withStatus('Berhasil unmark materi');
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
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function show(Modul $modul, Materi $materi)
    {
        return view('siswa.materi.show', compact('modul', 'materi'));
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
    public function update(Request $request, Materi $materi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materi $materi)
    {
        //
    }
}
