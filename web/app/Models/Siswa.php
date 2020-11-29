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

    public function materi()
    {
    	return $this->hasMany(SiswaMateri::class);
    }

    public function scopeIsMarked($query, ...$materi)
    {
        return $query->join('siswa_materis', 'siswa_materis.siswa_id', '=', 'siswas.id')->whereIn('siswa_materis.materi_id', collect($materi)->transform(fn($m) => $m->id))->exists();
    }
}
