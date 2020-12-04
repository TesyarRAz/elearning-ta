<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pelajarans()
    {
    	return $this->hasMany(Pelajaran::class);
    }

    public function moduls()
    {
    	return $this->hasMany(Modul::class);
    }

    public function bankSoals()
    {
        return $this->hasMany(BankSoal::class);
    }

    public function materis()
    {
        return $this->hasManyThrough(Materi::class, Modul::class);
    }

    public function tesses()
    {
        return $this->hasManyThrough(Tes::class, Modul::class);
    }

    public function quizes()
    {
        return $this->hasManyThrough(Quiz::class, Modul::class);
    }
}
