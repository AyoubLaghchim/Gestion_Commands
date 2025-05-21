<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.profile.profile");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view("admin.profile.edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation des données reçues
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . Auth::user()->id,
            'telephone' => 'required|string|max:20',
            'adresse'   => 'required|string|max:255',
        ]);
    
        // Récupérer uniquement les champs autorisés
        $data = $request->only(['name', 'email', 'telephone', 'adresse']);
    
        // Trouver l'utilisateur par son id
        $profile = User::findOrFail($id);
    
        // Mettre à jour les infos
        $profile->update($data);
    
        // Retour avec message de succès
        return redirect()->route('profile')->with('success', 'Profil mis à jour avec succès !');

        // return redirect()->back()->with("success", "Profil mis à jour avec succès !");
    }
    
    public function password(){

        return view('admin.profile.passwordChange');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
