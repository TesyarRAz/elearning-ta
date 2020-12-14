<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Modul;
use App\Models\Pelajaran;
use Illuminate\Http\Request;

class ModulController extends Controller
{
    public function data()
    {
        return datatables(auth()->user()->guru->moduls())->toJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelajarans = Pelajaran::latest()->get();

        return view('guru.modul.index', compact('pelajarans'));
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
            'kelas' => 'required',
            'pelajaran_id' => 'required|exists:pelajarans,id'
        ]);

        if ($request->has('gambar'))
        {
            $request->validate([
                'gambar' => 'required|file|image'
            ]);

            $data['gambar'] = \Storage::disk('dropbox')->url(
                $request->gambar->store('shares/upload', 'dropbox')
            );
        }

        if ($request->has('use_password'))
        {
            $data['password'] = \Str::random(8);
        }

        auth()->user()->guru->moduls()->create($data);

        return back()->withStatus('Berhasil tambah modul');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modul  $modul
     * @return \Illuminate\Http\Response
     */
    public function show(Modul $modul)
    {
        return response($modul);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Modul  $modul
     * @return \Illuminate\Http\Response
     */
    public function edit(Modul $modul)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Modul  $modul
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modul $modul)
    {
        $data = $request->validate([
            'name' => 'required',
            'keterangan' => 'required',
            'kelas' => 'required',
            'pelajaran_id' => 'required|exists:pelajarans,id',
        ]);

        if ($request->has('gambar'))
        {
            $request->validate([
                'gambar' => 'required|file|image'
            ]);

            $data['gambar'] = \Storage::disk('dropbox')->url(
                $request->gambar->store('shares/upload', 'dropbox')
            );
        }

        if ($request->has('use_password'))
        {
            if ($modul->password == null)
            {
                $data['password'] = \Str::random(8);
            }
        }
        else
        {
            $data['password'] = null;
        }

        $modul->update($data);

        return back()->withStatus('Berhasil edit modul');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modul  $modul
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modul $modul)
    {
        $modul->delete();

        return back()->withStatus('Berhasil hapus modul');
    }

    public function export(Modul $modul)
    {
        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\NilaiExport($modul),
            $modul->name . '.xlsx'
        );
    }
}
