<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Adresses;

class Adresses extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'avenue',
        'quartier',
        'commune',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\Adresses');
    }
}
