<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Commandes;
use App\Models\Articles;
use App\Models\Livraisons;
use App\Models\Gestions;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class Panier extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            if(auth()->check())
            {
                $gestion = Gestions::findOrFail(1);

                if(Auth::user()->role_id == 1)
                {
                    $commandes = [];
                } elseif(Auth::user()->role_id == 5)
                {
                    $commandes = Commandes::All()->where('user_id', Auth::user()->id)
                                    ->where('valide', 0);
                }

                return view('pages.article.panier', [
                    'gestion' => $gestion,
                    'commandes' => $commandes,
                    'notification' => parent::commande(),
                ]);
                
            } else{
                return redirect()->route('404');
            }
            
        } catch (Exception $e) {
            return redirect()->route('404');
        }
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
        try {
            
            if(auth()->check())
            {
                $request->validate([
                    'id_article' => ['required'],
                    'taille' => ['required'],
                    'quantite' => ['required'],
                ]);

                $gestion = Gestions::findOrFail(1);
                $article = Articles::findOrFail($request->id_article);
                
                if($article->prix < 20)
                {
                    $prix_total = ((double)$article->prix + (double)$gestion->gain_1) * $request->quantite;
                    $prix_unitaire = (double)$article->prix + (double)$gestion->gain_1;
                } elseif($article->prix >= 20){
                    $prix_total = ((((double)$article->prix / 100) * (double)$gestion->gain_2) + (double)$article->prix) * $request->quantite;
                    $prix_unitaire = (double)$article->prix / 100 * (double)$gestion->gain_2 + (double)$article->prix;
                }
                
                Commandes::create([
                    'user_id' => Auth::user()->id,
                    'article_id' => $request->id_article,
                    'taille' => $request->taille,
                    'prix_unitaire' => $prix_unitaire,
                    'quantite' => $request->quantite,
                    'prix_total' => $prix_total,
                ]);
                // RETOURNER USER A L'ACCUEIL
                return redirect()->route('index');

            } else{
                return redirect->route('404');
            }

        } catch (Exception $e) {
            return redirect()->route('404');
        }
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
        
        try {

            $gestion = Gestions::findOrFail(1);
            $article = Commandes::findOrFail($id);
            
            return view('pages.article.article_edit', [
                'gestion' => $gestion,
                'article' => $article,
                'notification' => parent::commande(),
                'tailles_1' => parent::taille_lettre(),
                'tailles_2' => parent::taille_chiffre(),
            ]);

        } catch (Exception $e) {

            return redirect()->route('404');

        }   
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
        $request->validate([
            'taille' => ['required'],
            'quantite' => ['required'],
        ]);
        
        Commandes::findOrFail($id)
                ->update([
                    'taille' => $request->taille,
                    'quantite' => $request->quantite,
                ]);

        return redirect()->route('Panier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $article = Commandes::findOrFail($id);
            $article->delete();

            return redirect()->route('Panier.index');

        } catch (Exception $e) {
            return redirect()->route('404');
        }
        
    }
}
