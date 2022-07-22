<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class Mot_de_passe extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.user.password_edit');
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

            $request->validate([
                'password_ancien' => ['required'],
                'password' => ['required'],
                'password_confirm' => ['required'],
            ]);
            
            // SUPRESSION DE SESSION ENCOURS
            Session::forget('changement_mp');

            // VERIFICATION DES INFORAMATIONS
            if(password_verify($request->password_ancien, Auth::user()->password))
            {
                if($request->password === $request->password_confirm)
                {
                    $user = User::findOrFail(Auth::user()->id)
                                ->update([
                                    'password' => Hash::make($request->password),
                                ]);

                    Session::put('succes', 'Mot de passe modifié avec succès');
                    return redirect()->route('Profil.index');

                } else{

                    Session::put('erreur', 'Mot de passe ne correspondent pas');
                    return redirect()->route('404');

                }

            } else{

                Session::put('erreur', 'Ancien mot de passe incorect');
                return redirect()->route('Profil.index');

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
