<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Modul;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function data(Modul $modul)
    {
        return datatables($modul->quizes()->latest())->toJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Modul $modul)
    {
        return view('guru.quiz.index', compact('modul'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'soal' => 'required'
        ]);

        $modul->quizes()->create($data);

        return back()->withStatus('Berhasil tambah quiz');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Modul $modul, Quiz $quiz)
    {
        if ($request->has('soal'))
        {
            return response($quiz->soal);
        }

        return response($quiz);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modul $modul, Quiz $quiz)
    {
        $data = $request->validate([
            'soal' => 'required'
        ]);

        $quiz->update($data);

        return back()->withStatus('Berhasil edit quiz');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modul $modul, Quiz $quiz)
    {
        $quiz->delete();

        return back()->withStatus('Berhasil hapus quiz');
    }
}
