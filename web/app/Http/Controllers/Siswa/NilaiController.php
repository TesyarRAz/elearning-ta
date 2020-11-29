<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\SiswaTes;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa_tesses = auth()->user()->siswa->tesses()->latest()->paginate(10);

        return view('siswa.nilai.tes', compact('siswa_tesses'));
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
     * @param  \App\Models\SiswaTes  $siswaTes
     * @return \Illuminate\Http\Response
     */
    public function show(SiswaTes $siswaTes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiswaTes  $siswaTes
     * @return \Illuminate\Http\Response
     */
    public function edit(SiswaTes $siswaTes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SiswaTes  $siswaTes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SiswaTes $siswaTes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiswaTes  $siswaTes
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiswaTes $siswaTes)
    {
        //
    }
}
