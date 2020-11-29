<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaTes extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'sisa_waktu' => 'datetime'
    ];

    public function tes()
    {
    	return $this->belongsTo(Tes::class);
    }

    public function pilihans()
    {
    	return $this->hasMany(SiswaTesPilihan::class);
    }

    public function banksoal()
    {
        return $this->tes->banksoal();
    }
}
