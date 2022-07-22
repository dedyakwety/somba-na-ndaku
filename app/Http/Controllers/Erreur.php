<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Erreur extends Controller
{
    public function erreur_404()
    {
        return view('pages.erreur.404');
    }
}
