<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Numeros extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'numero_id', 'id');
    }
}
