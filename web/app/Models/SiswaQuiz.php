<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaQuiz extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function quiz()
    {
    	return $this->belongsTo(Quiz::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('d-m-Y');
    }
}
