<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tesses()
    {
    	return $this->hasMany(SiswaTes::class);
    }

    public function quizes()
    {
        return $this->hasMany(SiswaQuiz::class);
    }

    public function materi()
    {
    	return $this->hasMany(SiswaMateri::class);
    }

    public function moduls()
    {
        return $this->hasMany(SiswaModul::class);
    }

    public function scopeIsMarkedMateri($query, ...$materi)
    {
        return $query
        ->join('siswa_materis', 'siswa_materis.siswa_id', 'siswas.id')
        ->whereIn('siswa_materis.materi_id', $materi)
        ->value('marked') ?? false;
    }

    public function scopeIsFollowModul($query, ...$modul)
    {
        return $query
        ->join('siswa_moduls', 'siswa_moduls.siswa_id', 'siswas.id')
        ->whereIn('siswa_moduls.modul_id', $modul)
        ->value('follow') ?? false;
    }
}
