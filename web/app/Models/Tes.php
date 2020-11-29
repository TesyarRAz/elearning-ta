<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tes extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function banksoal()
    {
    	return $this->belongsTo(BankSoal::class, 'bank_soal_id')->withCount('soals');
    }

    public function modul()
    {
    	return $this->belongsTo(Modul::class);
    }
}
