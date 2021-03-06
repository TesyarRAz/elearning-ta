<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
    	return view('guru.index');
    }

    public function profile()
    {
    	$user = auth()->user();
    	
    	return view('guru.profile', compact('user'));
    }
}
