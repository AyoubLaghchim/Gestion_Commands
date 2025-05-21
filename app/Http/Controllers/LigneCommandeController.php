<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LigneCommande;
use App\Models\Commande;
use App\Models\Produit;
class LigneCommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::all();
        $ligneCommandes = LigneCommande::with('produit', 'commande')->get();
        return view('admin.lignecommandes.index', compact('ligneCommandes','produits'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $commandes = Commande::all();
        $produits = Produit::all();
        return view('admin.lignecommandes.create', compact('commandes', 'produits'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'commande_id' => 'required|exists:commandes,id',
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
        ]);
    
        LigneCommande::create([
            'commande_id' => $request->commande_id,
            'produit_id' => $request->produit_id,
            'quantite' => $request->quantite,
        ]);
    
        return redirect()->route('lignecommandes.index')->with('success', 'Ligne de commande ajoutée avec succès !');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lignecommande = Lignecommande::findOrFail($id);
        return view('admin.Lignecommandes.show', compact('lignecommande'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lignecommandes = Lignecommande::findOrFail($id);
        $commandes = Commande::all();
        $produits = Produit::all();
        return view('admin.Lignecommandes.edit', compact('lignecommandes','commandes','produits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lignecommande = Lignecommande::findOrFail($id);
        $lignecommande->update($request->all());
        return redirect()->route('lignecommandes.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lignecommande = Lignecommande::findOrFail($id);
        $lignecommande->delete();
        return redirect()->route('lignecommandes.index');
    }
}
