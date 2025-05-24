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
        $request->validate([
            'nom'            => 'required|string|max:255',
            'prix_unitaire'  => 'required|numeric|min:0',
            'description'    => 'required|string',
            'stock'          => 'required|integer|min:0',
            'categorie_id'   => 'required|exists:categories,id',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Préparation des données
        $data = $request->only(['nom', 'prix_unitaire', 'description', 'stock', 'categorie_id']);

        // Gestion de l'image si présente
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images/produits'), $imageName);
            $data['image'] = $imageName;
        }

        // Création du produit
        Produit::create($data);

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
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
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix_unitaire' => 'required|numeric|min:0',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $produit = Produit::findOrFail($id);

        $data = $request->only(['nom', 'prix_unitaire', 'description', 'stock', 'categorie_id']);

        // S'il y a une nouvelle image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($produit->image && file_exists(public_path('images/produits/' . $produit->image))) {
                unlink(public_path('images/produits/' . $produit->image));
            }

            // Enregistrer la nouvelle image
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/produits'), $filename);
            $data['image'] = $filename;
        }

        $produit->update($data);

        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès.');
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
