<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\Client;
use App\Models\Categorie;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('login.register');
    }
    public function register(Request $request)
    {
        // Validation des données du formulaire d'inscription
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'telephone' => 'required|min:10',
            'adresse' => 'required|string|max:300',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Création du client lié à l'utilisateur
        Client::create([
            'user_id' => $user->id, // lier avec le user
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
        ]);

        // Connexion automatique après inscription
        Auth::login($user);

        return redirect()->route('login')->with('success', 'Inscription réussie ! Vous êtes maintenant connecté.');
    }




    public function showLoginForm()
    {
        return view('login.login');
    }
    // Traitement de la connexion
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Vérification du rôle de l'utilisateur
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/')->with('success', 'Connexion en tant qu\'admin !');
            } else {
                return redirect()->intended('/user')->with('success', 'Connexion réussie !');
            }
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ]);
    }


    // Page protégée
    public function home()
    {
        // $data = [
        //     'produitsCount' => Produit::count(),
        //     'clientsCount' => Client::count(),
        //     'commandesMois' => Commande::whereMonth('created_at', now()->month)->count(),
        //     'commandesEnAttente' => Commande::where('etat_commande', 'en cour')->count(),
        //     'commandesRecentes' => Commande::with('client')->latest()->take(5)->get(),
        //     'commandes' => Commande::with('client')->latest()->take(10)->get(),
        //     'chartLabels' => ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil'],
        //     'chartData' => [65, 59, 80, 81, 56, 55, 40] // Remplacer par des données réelles
        // ];
        return view('admin.home',[
            'produitsCount' => Produit::count(),
            'clientsCount' => Client::count(),
            'commandesMois' => Commande::whereMonth('created_at', now()->month)->count(),
            'commandesEnAttente' => Commande::where('etat_commande', 'en cour')->count(),
            'commandeslivrer' => Commande::where('etat_commande', 'terminée')->count(),
            'commandesAnnuller' => Commande::where('etat_commande', 'annulée')->count(),
            'commandesRecentes' => Commande::with('client')->latest()->take(5)->get(),
            'commandes' => Commande::with('client')->latest()->take(10)->get(),
            'chartLabels' => ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil'],
            'chartData' => [65, 59, 80, 81, 56, 55, 40] ,// Remplacer par des données réelles
            'TotalCategories' => Categorie::count(),
        ]);
    }   
// Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}
