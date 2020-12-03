<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Modul;
use App\Models\Materi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function profile()
    {
        $user = auth()->user();

        return view('siswa.profile', compact('user'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $top_moduls = Modul::withCount('materis', 'tesses', 'quizes')->latest();

        if ($request->has('search') && !empty($request->search))
        {
            $top_moduls
            ->join('pelajarans', 'moduls.pelajaran_id', '=', 'pelajarans.id')
            ->where('moduls.name', 'rlike', $request->search)
            ->orWhere('pelajarans.name', $request->search)
            ->orWhere('kelas', 'rlike', $request->search);
        }

        $top_moduls = $top_moduls->paginate(10);

        return view('siswa.index', compact('top_moduls'));
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
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        //
    }
}
