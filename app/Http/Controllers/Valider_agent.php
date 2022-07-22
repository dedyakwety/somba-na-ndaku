<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Roles;
use App\Models\Numeros;

class Valider_agent extends Controller
{
    public function validation_agent(Request $request)
    {

        try {

            $request->validate([
                'email' => ['required'],
                'role' => ['required'],
                'password' => ['required'],
            ]);
            
            if(password_verify($request->password, Auth::user()->password))
            {
                // RECUPERER ID DE L'UTILISATEUR
                $user_id = User::select('id')->where('email', $request->email)->first()->id;
                // RECUPERER L'UTILISATEUR
                $user = User::findOrFail($user_id);
                // RECUPER
                $numero = Numeros::findOrFail($user->numero->id);

                User::where('email', $request->email)
                    ->update([
                        'role_id' => $request->role,
                        'numero_id' => null,
                    ]);
                    
                // SUPRIMER LE NUMERO
                $numero->delete();
                
                Session::put('succes', "Le role de l'adresse email ".$request->email." est maintenant ".Roles::findOrFail($request->role)->role). " de SOMBA NA NDAKU";
                return redirect()->route('Agents.index');

            } else{
                Session::put('erreur', 'une erreur');
                return redirect()->route('Agents.index');
            }

        } catch (Exception $e) {

            return redirect()->route('404');
            
        }
        
    }
}
