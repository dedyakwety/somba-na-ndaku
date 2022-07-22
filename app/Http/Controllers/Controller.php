<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Auth;
use App\Models\Commandes;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function commande()
    {
        if(auth()->check())
        {
            if(Auth::user()->role_id == 1)
            {
                

            } elseif(Auth::user()->role_id == 5)
            {
                $commande = Commandes::All()
                                    ->where('user_id', Auth::user()->id)
                                    ->where('valide', 0);
            }

            if(Auth::user()->role_id == 1)
            {

            } elseif(Auth::user()->role_id == 5)
            {
                return count($commande);
            }
        }
    }

    public function communes()
    {
        $communes = [
            "bandalungwa" => "Bandalungwa",
            "barumbu" => "Barumbu",
            "bumbu" => "Bumbu",
            "kalamu" => "Kalamu",
            "kinsenso" => "Kinsenso",
            "kimbanseke" => "Kimbanseke",
            "masine" => "Masina",
            "ndjili" => "Nd'jili",
            "matete" => "Matété",
            "kasa_vubu" => "Kasa-Vubu",
            "gombe" => "Gombé",
            "maluku" => "Maluku",
            "nsele" => "N'sele",
            "kitambo" => "Kitambo",
            "limete" => "Limeté",
            "kinshasa" => "Kinshasa",
            "lingwala" => "Lingwala",
            "mont_ngafula" => "Mont-Ngafula",
            "lemba" => "Lemba",
            "ngaliema" => "Ngaliema",
            "makala" => "Makala",
            "celembao" => "Celembao",
            "ngaba" => "Ngaba",
            "ngiri_ngiri" => "Ngiri ngiri",
        ];

        return $communes;
    }

    public function roles()
    {
        $roles = [
            'PDG' => 'PDG',
            'DG' => 'DG',
            'DM' => 'DM',
            'AL' => 'AL',
            'CL' => 'CL',
        ];

        return $roles;
    }

    public function pours()
    {
        $pours = [
            'homme' => 'homme',
            'femme' => 'femme',
            'enfants' => 'enfants',
        ];

        return $pours;
    }

    public function categories()
    {
        $categories = [
            'habillement' => 'habillement',
            'chaussures' => 'chaussure',
            'accessoire' => 'accessoire',
            'kabelo' => 'kabelo',
        ];

        return $categories;
    }

    public function modeles()
    {
        $modeles = [
            'veste' => 'veste',
            'chemise' => 'chemise',
            'pantallon' => 'pantallon',
            'culotte' => 'culotte',
            'lacoste' => 'lacoste',
            't-short' => 't-short',
            'par dessus' => 'par dessus',
            'trico' => 'trico',
            'survette' => 'survette',

            'ketshe' => 'ketshe',
            'soullier' => 'soullier',
            'perpette' => 'perpette',
            'sandale' => 'sandale',
            'boot' => 'boot',
            'mocassin' => 'mocassin',
            'babouche' => 'babouche',
            'talon' => 'talon',
            'fermer' => 'fermer',
            'sebako' => 'sebako',

            'ya mayi' => 'ya mayi',
            'noemal' => 'normal',
        ];

        return $modeles;
    }

    public function taille_chiffre()
    {
        $tailles = [];
        for($i=20; $i<=46; $i++)
        {
            array_push($tailles, $i);
        }
        return $tailles;
    }

    public function taille_lettre()
    {
        $tailles = [
            'XXS' => 'XXS',
            'XS' => 'XSS',
            'S' => 'S',
            'M' => 'M',
            'L' => 'L',
            'XL' => 'XL',
            'XXL' => 'XXL',
        ];
        return $tailles;
    }
}
