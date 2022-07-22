<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Images;
use App\Models\Gestions;
use App\Models\Adresses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class Completer_compte extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.user.completer_compte', [
            'communes' => parent::communes(),
        ]);
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
        if(Auth::user()->role_id == 1)
        {
            $request->validate([
                'photo_profil' => ['required'],
                'gain_1' => ['required'],
                'gain_1' => ['required'],
                'remise' => ['required'],
                'transport' => ['required'],
                'depense' => ['required'],
                'agent' => ['required'],
                'admin' => ['required'],
                'entreprise' => ['required'],
            ]);

            // ENREGISTREMENT DE LA PHOTO DE PROFIL
            $path = $request->photo_profil->storeAs(
                'images/user/profil'.$request->id,
                Auth::user()->id.".".$request->photo_profil->getClientOriginalExtension(),
                'public',
            );
            // Si la taille d'image est superieur 1.5mb Suprimer Envoi exception 
            if((((double)Storage::size("public/".$path) / 1024) / 1024) > 1.5)
            {
                Storage::disk('public')->delete("public/".$path);
                // RETOUR AVEC MESSAGE
                Session::put('erreur', 'La photo est trop lourde doit avoir au max 1.5MB');
                return redirect()->route('Completion_compte.index');
            }
            Images::create([
                'user_id' => Auth::user()->id,
                'profil' => $path,
            ]);
            //ENREGITREMENT GESTION
            Gestions::create([
                'gain_1' => $request->gain_1,
                'gain_2' => $request->gain_2,
                'remise' => $request->remise,
                'transport' => $request->transport,
                'depense' => $request->depense,
                'agent' => $request->agent,
                'admin' => $request->admin,
                'entreprise' => $request->entreprise,
            ]);

        } else{

            $request->validate([
                'photo_profil' => ['required'],
                'postnom' => ['required'],
                'numero' => ['required'],
                'avenue' => ['required'],
                'quartier' => ['required'],
                'commune' => ['required'],
            ]);
            // ENREGISTREMENT DE LA PHOTO DE PROFIL
            $path = $request->photo_profil->storeAs(
                'images/user/profil'.$request->id,
                Auth::user()->id.".".$request->photo_profil->getClientOriginalExtension(),
                'public',
            );
            // Si la taille d'image est superieur 1.5mb Suprimer Envoi exception 
            if((((double)Storage::size("public/".$path) / 1024) / 1024) > 1.5)
            {
                Storage::disk('public')->delete("public/".$path);
                // RETOUR AVEC MESSAGE
                Session::put('erreur', 'La photo est trop lourde doit avoir au max 1.5MB');
                return redirect()->route('Completion_compte.index');
            }
            Images::create([
                'user_id' => Auth::user()->id,
                'profil' => $path,
            ]);
            // ENREGISTREMENT D'ADRESSE
            $id_adresse = Adresses::create([
                'numero' => $request->numero,
                'avenue' => $request->quartier,
                'quartier' => $request->quartier,
                'commune' => $request->commune,
            ])->id;

            User::findOrFail(Auth::user()->id)
                ->update([
                    'postnom' => $request->postnom,
                    'adresse_id' => $id_adresse,
                ]);

        }

        return redirect()->route('index');
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
