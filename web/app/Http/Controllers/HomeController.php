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
            'upload' => 'required|file',
            'CKEditorFuncNum' => 'required|numeric'
        ]);

        $response = $request->upload->store('shares/upload', 'dropbox');
        $function_number = $request->CKEditorFuncNum;

        return response("<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '" . \Storage::disk('dropbox')->url($response) ."', '');</script>");
    }
}
