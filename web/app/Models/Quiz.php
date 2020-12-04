<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function modul()
    {
    	return $this->belongsTo(Modul::class);
    }

    protected function serializeDate(\DateTimeInterface $date)
	{
	    return $date->format('d-m-Y');
	}
}
