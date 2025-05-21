<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $produits = Produit::all();
        $produits = Produit::with('categorie')->get();
        return view("admin.produits.index",compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Categorie::all();
        return view('admin.produits.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $produit = Produit::create($request->all());
        return redirect()->Route('produits.index')->with('success', 'Produit ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $produit = Produit::findOrFail($id);
        $nombreVentes = $produit->ligneCommandes->sum('quantite');
        return view('admin.produits.show',compact('produit','nombreVentes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        $categories = Categorie::all();
        return view('admin.produits.edit', compact('produit', 'categories'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'nom' => 'required|string|max:255',
        //     'prix' => 'required|numeric',
        //     'quantite' => 'required|integer',
        //     'categorie_id' => 'required|exists:categories,id',
        // ]);

        $produit = Produit::findOrFail($id);
        $produit->update($request->all());

        return redirect()->route('produits.index')->with('success', 'Produit modifié avec succès !');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $produit = Produit::findOrFail($id);
        $produit->delete();
        return redirect()->route('produits.index');
    }
}
