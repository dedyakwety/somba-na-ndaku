<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use App\Models\Roles;
use App\Models\Adresses;
use App\Models\Pours;
use App\Models\Categories;
use App\Models\Modeles;
use App\Models\Numeros;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::All();

        return view('auth.register', [
            'communes' => parent::communes(),
            'users' => $users,
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        try {

            $users = User::All();

            if(count($users) == 0)
            {

                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'postnom' => ['required', 'string', 'max:255'],
                    'prenom' => ['required', 'string', 'max:255'],
                    'sexe' => ['required', 'string', 'max:255'],
                    'etat_civil' => ['required', 'string', 'max:255'],
                    'contact_whatsapp' => ['required', 'min:9', 'max:10'],
                    'contact' => ['required', 'min:9', 'max:10'],
                    'numero' => ['required', 'max:10'],
                    'avenue' => ['required', 'string', 'max:255'],
                    'quartier' => ['required', 'string', 'max:255'],
                    'commune' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);

                // EBREGISTREMENT DES ROLES
                foreach (parent::roles() as $role) {
                    Roles::create([
                        'role' => $role,
                    ]);
                }

                // ENREGISTREMENT D'ADRESSE
                $id_adresse = Adresses::create([
                    'numero' => $request->numero,
                    'avenue' => $request->avenue,
                    'quartier' => $request->quartier,
                    'commune' => $request->commune,
                ])->id; 

                // POURS 
                foreach(parent::pours() as $pour)
                {
                    Pours::create([
                        'pour' => $pour,
                    ]);
                }
                // CATEGORIES
                foreach(parent::categories() as $categorie)
                {
                    Categories::create([
                        'categorie' => $categorie,
                    ]);
                }
                // MODELES
                foreach(parent::modeles() as $modele)
                {
                    Modeles::create([
                        'modele' => $modele,
                    ]);
                }

                // ENREGISTREMENT USER
                $user = User::create([
                    'role_id' => 1,
                    'adresse_id' => $id_adresse,
                    'name' => $request->name,
                    'postnom' => $request->postnom,
                    'prenom' => $request->prenom,
                    'sexe' => $request->sexe,
                    'etat_civil' => $request->etat_civil,
                    'contact_whatsapp' => $request->contact_whatsapp,
                    'contact' => $request->contact,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                // REDIRECTION D'UTILISATEUR POUR SE CONNECTE
                return redirect()->route('login');

            } else{

                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'prenom' => ['required', 'string', 'max:255'],
                    'sexe' => ['required', 'string', 'max:255'],
                    'contact_whatsapp' => ['required', 'min:9', 'max:10'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);

                $user = User::create([
                    'role_id' => 5,
                    'name' => $request->name,
                    'prenom' => $request->prenom,
                    'sexe' => $request->sexe,
                    'contact_whatsapp' => $request->contact_whatsapp,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ])->id;
                
                if(strlen($user) == 1)
                {
                    $user_id = "000".$user;
                } elseif(strlen($user) == 2)
                {
                    $user_id = "00".$user;
                } elseif(strlen($user) == 3)
                {
                    $user_id = "0".$user;
                } elseif(strlen($user) == 4)
                {
                    $user_id = $user;
                }

                // 3 enfants, 5 id du rôle, id du clientet 4 chiffres aléatoires
                $numero = "35".$user_id."".rand(1000, 9999);
                
                $numero_id = Numeros::create([
                    'numero' => $numero,
                ])->id;

                User::findOrFail($user)
                    ->update([
                        'numero_id' => $numero_id,
                    ]);

                // REDIRECTION D'UTILISATEUR POUR SE CONNECTE
                return redirect()->route('login');
            }

        } catch (Exception $e) {

            return redirect()->route('404');
            
        }

        //event(new Registered($user));

        //Auth::login($user);

        //return redirect(RouteServiceProvider::HOME);

    }
}
