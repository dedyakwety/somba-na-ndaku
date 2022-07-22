<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Livraisons;
use App\Models\Articles;
use App\Models\Commandes;
use App\Models\Gestions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Livraison extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_livraison' => ['required'],
            'heure_livraison' => ['required'],
            'adresse_livraison' => ['required'],
        ]);

        $gestion = Gestions::findOrFail(1);
        $achat_numero = (int)Livraisons::where('user_id', Auth::user()->id)->count() + 1;
        $commandes = Commandes::All()
                            ->where('user_id', Auth::user()->id)
                            ->where('valide', false);
        $remise = ((double)$commandes->sum('prix_total') / 100) * ($gestion->remise);
        // VERIFIER SI C'EST LA 5ème LIVRAISON
        $verifier_remise = Livraisons::All()
                                    ->where('user_id', Auth::user()->id)
                                    ->where('montant_remise', false);
        if(count($verifier_remise) == 4)
        {
            $reception_remise = $verifier_remise->sum('remise');
        } else{
            $reception_remise = null;
        }
        // ENREGISTREMENT D'INFORMATION DE LA LIVRAISON
        $livraison = Livraisons::create([
            'user_id' => Auth::user()->id,
            'achat_numero' => $achat_numero,
            'date_livraison' => $request->date_livraison,
            'heure_livraison' => $request->heure_livraison,
            'adresse_livraison' => $request->adresse_livraison,
            'nombre_article' => count($commandes),
            'prix_total' => (double)$commandes->sum('prix_total'),
            'remise_pourcentage' => $gestion->remise,
            'remise' => $remise,
            'montant_remise' => $reception_remise,
        ])->id;
        // MODIFIER LES COMMANDES EN VALIDE
        foreach($commandes as $commande)
        {
            Commandes::findOrFail($commande->id)
                    ->update([
                        'livraison_id' => $livraison,
                        'valide' => true,
                    ]);
        }
        // UN MESSAGE AVEC SUCCESS
        Session::put('succes', 'Votre commande à été validée avec succès préparez vous a recevoir votre commande '.$request->date_livraison." à ".$request->heure_livraison);
        return redirect()->route('Panier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
