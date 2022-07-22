<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Articles;

class Modeles extends Model
{
    use HasFactory;

    protected $fillable = [
        'modele',
    ];

    public function articles()
    {
        return $this->hasMany('App\Models\Articles');
    }
}
