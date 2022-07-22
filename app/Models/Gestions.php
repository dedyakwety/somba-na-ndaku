<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestions extends Model
{
    use HasFactory;

    protected $fillable = [
        'gain_1',
        'gain_2',
        'remise',
        'transport',
        'depense',
        'agent',
        'admin',
        'entreprise',
    ];
}
