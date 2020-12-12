<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Modul;

class ModulController extends Controller
{
    public function index(Request $request)
    {
        $moduls = auth()->user()->siswa->moduls()->with('modul')->whereFollow(true)->latest();

        if ($request->has('search') && !empty($request->search))
        {
            $moduls
            ->join('pelajarans', 'moduls.pelajaran_id', '=', 'pelajarans.id')
            ->where('moduls.name', 'rlike', $request->search)
            ->orWhere('pelajarans.name', $request->search)
            ->orWhere('kelas', 'rlike', $request->search)
            ->orWhere('password', $request->search);
        }

        $moduls = $moduls->paginate(10);

        return view('siswa.modul.index', compact('moduls'));
    }
    public function follow(Modul $modul)
    {
    	auth()->user()->siswa->moduls()->whereModulId($modul->id)->updateOrCreate(
    		[ 'modul_id' => $modul->id ],
    		[ 'follow' => true]
    	);

    	return back()->withStatus('Berhasil Follow Modul');
    }

    public function unfollow(Modul $modul)
    {
    	auth()->user()->siswa->moduls()->whereModulId($modul->id)->updateOrCreate(
    		[ 'modul_id' => $modul->id ],
    		[ 'follow' => false]
    	);

    	return back()->withStatus('Berhasil Unfollow Modul');
    }
}
