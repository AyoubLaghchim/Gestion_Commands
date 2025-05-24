<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clients = Client::all();
        return view('admin.clients.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $client = Client::create($request->all());
        return redirect()->Route('clients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $client = Client::findOrFail($id);
        return view('admin.clients.show',compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(client  $client)
    {
        //
        return view('admin.clients.edit' ,compact('client'));
        
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, string $id)
{
    // Récupérer le client et son user avant la validation
    $client = Client::with('user')->findOrFail($id);
    $user   = $client->user;

    // Validation
    $request->validate([
        // Champs Client
        'nom'       => 'required|string|max:255',
        'telephone' => 'required|string|max:20',
        'adresse'   => 'required|string|max:255',

        // Champs User
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role'  => 'required|string|in:admin,client',
    ]);

    // Mise à jour du client
    $client->update([
        'nom'       => $request->nom,
        'telephone' => $request->telephone,
        'adresse'   => $request->adresse,
    ]);

    // Mise à jour de l'utilisateur lié
    $user->update([
        'email' => $request->email,
        'role'  => $request->role,
    ]);

    return redirect()
        ->route('clients.index')
        ->with('success', 'Client et utilisateur mis à jour avec succès.');
}



    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
    {
        $client = Client::findOrFail($id);

        // Supprime d'abord l'utilisateur lié
        $client->user()->delete();

        // Ensuite, supprime le client
        $client->delete();

        return redirect()->route('clients.index');
    }

}
