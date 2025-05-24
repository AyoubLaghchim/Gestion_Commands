<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Produit;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Récupérer les commandes de l'utilisateur connecté, triées par date décroissante
        $commandes = Commande::where('client_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Statistiques simples
        $commandesEnCours = $commandes->where('etat_commande', 'en cour')->count();
        $commandesLivrees = $commandes->where('etat_commande', 'annulée')->count();
        $commandesEnAttente = $commandes->where('etat_commande', 'terminée')->count();

        return view('users.menu', [
            'commandes' => $commandes,
            'commandesEnCours' => $commandesEnCours,
            'commandesLivrees' => $commandesLivrees,
            'commandesEnAttente' => $commandesEnAttente,
        ]);
        // return view('users.menu');
    }
    public function show($id)
    {
        $client = Auth::user();
        $commande = Commande::where('id', $id)
        ->where('client_id', $client->id) // si tu as une variable $client représentant le client connecté
        ->with('lignes.produit') // si tu veux charger les produits via la table ligne_commandes
        ->firstOrFail();


        return view('users.detailcommande', compact('commande'));
    }

    public function create()
    {
        $produits = Produit::all(); // Récupérer tous les produits disponibles
        return view('users.createCommand',compact('produits'));
    }

    public function store(Request $request)
        {
            // Validation : 'produits' doit être une chaîne JSON valide et non vide
            $request->validate([
                'produits' => ['required', 'string'],
            ]);

            $user = Auth::user();

            // Décoder le JSON contenant les produits sélectionnés
            $produits = json_decode($request->input('produits'), true);

            // Vérifier que c'est bien un tableau
            if (!is_array($produits) || empty($produits)) {
                return back()->withErrors(['produits' => 'Veuillez sélectionner au moins un produit.'])->withInput();
            }

            // Valider chaque produit dans le tableau
            foreach ($produits as $prod) {
                if (!isset($prod['id'], $prod['quantite']) || !is_numeric($prod['quantite']) || $prod['quantite'] < 1) {
                    return back()->withErrors(['produits' => 'Données de produit invalides.'])->withInput();
                }
                // Vérifie que le produit existe bien en base
                if (!Produit::find($prod['id'])) {
                    return back()->withErrors(['produits' => "Le produit ID {$prod['id']} n'existe pas."])->withInput();
                }
            }

            // Créer la commande associée au client
            $commande = Commande::create([
                'client_id' => $user->client->id,  // Assure-toi que la relation user->client existe
                'date_commande' => now(),
                'statut' => 'en cours', // ou autre statut par défaut
            ]);

            // Créer les lignes de commande pour chaque produit
            foreach ($produits as $prod) {
                LigneCommande::create([
                    'commande_id' => $commande->id,
                    'produit_id' => $prod['id'],
                    'quantite' => $prod['quantite'],
                ]);
            }

            return redirect()->route('menu', $commande->id)
                ->with('success', 'Commande passée avec succès !');
        }

    public function showProduits(){
        $produits = Produit::all();
        return view('users.showproduits',compact('produits'));
    }
}
