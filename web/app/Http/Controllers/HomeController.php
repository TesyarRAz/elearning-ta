<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
