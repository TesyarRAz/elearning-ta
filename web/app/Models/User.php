<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'api_token',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function guru()
    {
        return $this->hasOne(Guru::class);
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }

    public function adminlte_image()
    {
        return asset('assets/images/avatar.png');
    }

    public function adminlte_desc()
    {
        return optional($this->role())->name ?? $this->username;
    }

    public function adminlte_profile_url()
    {
        return route(auth()->user()->role . '.profile');
    }

    public function role()
    {
        if ($this->role == 'guru')
            return $this->guru;
        
        if ($this->role == 'siswa')
            return $this->siswa;

        return null;
    }

    public function roleRelations()
    {
        if ($this->role == 'guru')
            return $this->guru();
        
        if ($this->role == 'siswa')
            return $this->siswa();

        return null;
    }

    public function state()
    {
        return $this->hasOne(UserState::class);
    }
}
