<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeController extends Controller
{
    public function index()
    {
    	if (auth()->check())
    	{
    		if (auth()->user()->can('user_guru'))
    			return redirect()->route('guru.index');
    		if (auth()->user()->can('user_admin'))
    			return redirect()->route('admin.index');
            if (auth()->user()->can('user_siswa'))
                return redirect()->route('siswa.index');
    	}

    	return view('home');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'upload' => 'required|file|image'
        ]);

        $response = \Http::acceptJson()
        ->attach(
            'file', $request->upload->get(), $request->upload->getClientOriginalName()
        )
        ->attach(
            'attributes', with(new JsonResource([
                'name' => $request->upload->hashName(),
                'parent' => '127288623677'
            ]), fn($item) => $item->toJson())
        )
        ->withToken('DSLSQC1U1R32kmzI7rwfr6P4CbClqE5T')
        ->post('https://upload.box.com/api/2.0/files/content');

        dd($response);

        return $response->status();
    }
}
