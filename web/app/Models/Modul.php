<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function materis()
    {
    	return $this->hasMany(Materi::class);
    }

    public function tesses()
    {
    	return $this->hasMany(Tes::class);
    }

    public function quizes()
    {
    	return $this->hasMany(Quiz::class);
    }

    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
