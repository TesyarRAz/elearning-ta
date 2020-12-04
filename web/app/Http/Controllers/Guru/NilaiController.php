<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\SiswaTes;
use App\Models\SiswaQuiz;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function tes()
    {
        $data = SiswaTes::select('siswa_tes.*')->join('tes', 'tes.id', '=', 'siswa_tes.tes_id')
        ->join('moduls', 'moduls.id', '=', 'tes.modul_id')
        ->where('moduls.guru_id', auth()->user()->guru->id)
        ->paginate(10);

        return view('guru.nilai.tes', compact('data'));
    }

    public function quiz()
    {
        $data = SiswaQuiz::select('siswa_quizzes.*')->join('quizzes', 'quizzes.id', '=', 'siswa_quizzes.quiz_id')
        ->join('moduls', 'moduls.id', '=', 'quizzes.modul_id')
        ->where('moduls.guru_id', auth()->user()->guru->id)
        ->paginate(10);

        return view('guru.nilai.quiz', compact('data'));
    }

    public function showQuiz(Request $request, SiswaQuiz $siswa)
    {
        if ($request->has('soal'))
        {
            return response($siswa->quiz->soal);
        }

        if ($request->has('jawab'))
        {
            return response($siswa->jawaban);
        }
    }

    public function postQuiz(Request $request, SiswaQuiz $siswa)
    {
        $data = $request->validate([
            'nilai' => 'required|numeric'
        ]);

        $data['dinilai'] = true;

        $siswa->update($data);

        return back()->withStatus('Berhasil Dinilai');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
