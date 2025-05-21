<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Client;
class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commandes = Commande::with('client')->get();
        return view('admin.commandes.index', compact('commandes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();  // Récupère tous les clients
        return view('admin.commandes.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'date_commande' => 'required|date',
        'client_id' => 'required|exists:clients,id',
        'etat_commande' => 'required|in:en cour,terminée,annulée'
    ]);

    Commande::create([
        'date_commande' => $request->date_commande,
        'client_id' => $request->client_id, // Ici, il doit être présent !
        'etat_commande' => $request->etat_commande,
    ]);

    return redirect()->route('commandes.index')->with('success', 'Commande ajoutée avec succès !');
}
    public function show(string $id)
    {
        //
        $commande = Commande::findOrFail($id);
        return view('admin.commandes.show', compact('commande'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $commande = Commande::findOrFail($id);
        $clients = Client::all();  // Récupère tous les clients

        return view('admin.commandes.edit',compact('commande','clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $commande = Commande::findOrFail($id);
        $commande->update($request->all());
        return redirect()->route("commandes.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $commande = Commande::findOrFail($id);
        $commande->delete();
        return redirect()->route("commandes.index");
    }
   

}
