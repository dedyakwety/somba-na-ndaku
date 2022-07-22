<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Articles;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'categorie',
    ];

    public function articles()
    {
        return $this->hasMany('App\Models\Articles');
    }
}
