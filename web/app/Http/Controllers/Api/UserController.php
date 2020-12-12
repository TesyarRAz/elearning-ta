<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api')->only('index');
	}

	public function index()
	{
        auth()->user()->with('guru')->with('siswa');
		return response([
			'data' => auth()->user()
		]);
	}

    public function login(Request $request)
    {
    	$data = $request->validate([
            'username_email' => 'required',
            'password' => 'required'
        ]);

        // Login dengan membadingkan email dan username
        $user = User::where(function($query) use ($data) {
            return $query->where('username', $data['username_email'])->orWhere('email', $data['username_email']);
        })->first();

        if (!empty($user) && \Hash::check($data['password'], $user['password']))
        {
            auth()->login($user);

    		auth()->user()->update(['api_token' => \Str::random(40)]);

    		return response([
    			'code' => 1,
    			'message' => '',
    			'data' => auth()->user()
    		]);
    	}

    	return response([
    		'code' => 0,
    		'message' => 'Anda tidak terdaftar di basis data kami',
    		'errors' => [
    			'username_email' => 'Anda tidak terdaftar di basis data kami'
    		]
    	], 401);
    }
}
