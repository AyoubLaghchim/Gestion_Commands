<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Commande;
use App\Models\Produit;
use Illuminate\Http\Request;

class RechercheController extends Controller
{
    // 🌟 Méthode pour afficher le formulaire de recherche
    public function rechercheParClient()
    {
        $clients = Client::all();
        return view('admin.recherche.commandes_par_client', compact('clients'));
    }

    // 🌟 Méthode pour afficher les commandes du client sélectionné
    public function afficherCommandesClient(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id'
        ]);

        $client = Client::with('commandes.ligneCommandes.produit')->findOrFail($request->client_id);

        return view('admin.recherche.resultats_commandes_client', compact('client'));
    }
     // 🌟 Méthode pour afficher le formulaire de recherche par période et état
     public function rechercheParPeriodeEtat()
     {
         $annees = Commande::selectRaw('YEAR(date_commande) as year')->distinct()->pluck('year');
         return view('admin.recherche.periode_etat', compact('annees'));
     }
 
     // 🌟 Méthode pour afficher les résultats de la recherche
     public function resultatParPeriodeEtat(Request $request)
        {
         $request->validate([
             'annee' => 'required',
             'mois' => 'required',
             'etat' => 'required'
         ]);
 
         $commandes = Commande::whereYear('date_commande', $request->annee)
             ->whereMonth('date_commande', $request->mois)
             ->where('etat_commande', $request->etat)
             ->get();
 
         $montantTotal = $commandes->sum(function ($commande) {
             return $commande->ligneCommandes->sum(function ($ligne) {
                 return $ligne->produit->prix_unitaire * $ligne->quantite;
             });
         });
 
         return view('admin.recherche.resultats_periode_etat', compact('commandes', 'montantTotal'));
        }
    public function statistiquesParProduit()
    {
        // Récupérer tous les produits avec leurs lignes de commande
        $produits = Produit::with('ligneCommandes')->get();

        // Calculer les statistiques pour chaque produit
        $statistiques = $produits->map(function ($produit) {
            $quantiteTotale = $produit->ligneCommandes->sum('quantite');
            $chiffreAffaires = $produit->ligneCommandes->sum(function ($ligne) {
                return $ligne->quantite * $ligne->produit->prix_unitaire;
            });

            return [
                'produit' => $produit->nom,
                'quantite_totale' => $quantiteTotale,
                'chiffre_affaires' => $chiffreAffaires
            ];
        });

        return view('admin.recherche.statistiques_produit', compact('statistiques'));
    } 
}
