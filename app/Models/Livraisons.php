<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Commandes;

class Livraisons extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'livreur_id',
        'achat_numero',
        'date_livraison',
        'heure_livraison',
        'adresse_livraison',
        'nombre_article',
        'prix_total',
        'remise_pourcentage',
        'remise',
        'montant_remise',
    ];

    public function commandes()
    {
        return $this->hasMany('App\Models\Commandes');
    }
}
