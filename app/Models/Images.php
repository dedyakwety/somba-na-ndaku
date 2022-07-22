<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Articles;
use Illuminate\Support\Facades\Storage;

class Images extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'article_id',
        'profil',
        'path_1',
        'path_2',
        'path_3',
        'path_4',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'article_id', 'id');
    }

    public function article()
    {
        return $this->belongsTo('App\Models\Articles');
    }
}
