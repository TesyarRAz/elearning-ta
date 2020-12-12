<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaModul extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function modul()
    {
    	return $this->belongsTo(Modul::class);
    }
}
