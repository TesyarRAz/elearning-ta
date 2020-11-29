<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('logout');
        $this->middleware('guest')->except('logout');
    }

    public function showLogin()
    {
        return view('auth.login');
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

        if (\Hash::check($data['password'], $user['password']))
        {
            auth()->login($user);
            
            return redirect()->route('home');
        }

        return back()->withErrors(['username_email' => 'Anda tidak terdaftar di basis data kami']);
    }

    public function showRegister(Request $request)
    {
        if ($request->has('verification'))
        {
            $user = User::where('username', $request->verification)->firstOrFail();

            return view('auth.register', $request->only('verification'));
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        if ($request->has('verification'))
        {
            $user = User::where('username', $request->verification)->firstOrFail();

            abort_if(!$user->hasVerifiedEmail(), 404);

            $data = $request->validate([
                'username' => 'required|unique:users|min:5',
                'password' => 'required|min:5'
            ]);

            $data['password'] = bcrypt($data['password']);

            $user->update($data);

            auth()->login($user);

            return redirect()->route('home');
        }

        $request->merge(['alamat' => '']);
        $request->merge(['username' => \Str::random(20)]);
        $request->merge(['password' => \Str::random(10)]);

        $data_user = $request->validate([
            'gender' => 'required|in:l,p',
            'role' => 'required|in:siswa,guru',
            'email' => 'required|email|unique:users',
            'username' => 'required',
            'password' => 'required'
        ]);

        $data_role = $request->validate([
            'name' => 'required|min:5',
            'alamat' => 'bail'
        ]);

        $user = User::create($data_user);

        $user->roleRelations()->create($data_role);

        return back()
        ->withStatus('Berhasil daftar, silahkan cek email untuk konfirmasi');
    }

    public function verify(Request $request, User $user)
    {
        $user->markEmailAsVerified();

        return redirect()
        ->route('register', ['verification' => $user->username])
        ->withStatus('Berhasil verifikasi email anda, silahkan lanjutkan pengisian data');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
