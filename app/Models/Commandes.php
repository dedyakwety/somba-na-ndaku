<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Livraisons;
use App\Models\User;
use App\Models\Articles;

class Commandes extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'article_id',
        'livraison_id',
        'taille',
        'prix_unitaire',
        'quantite',
        'prix_total',
        'valide',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\user');
    }

    public function livraison()
    {
        return $this->belongsTo('App\Models\Livraisons');
    }

    public function article()
    {
        return $this->belongsTo('App\Models\Articles');
    }
}
