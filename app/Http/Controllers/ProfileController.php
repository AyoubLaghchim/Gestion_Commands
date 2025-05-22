<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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
   public function update(Request $request)
    {
        // Validation des données reçues
        $request->validate([
            'nom'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . Auth::user()->id,
            'telephone' => 'required|string|max:20',
            'adresse'   => 'required|string|max:255',
        ]);

        // Données pour chaque table
        $userdata = $request->only(['nom', 'email']);
        $clientdta = $request->only(['nom', 'telephone', 'adresse']);

        // Récupérer l'utilisateur
        $updateUser = User::findOrFail(id: Auth::user()->id);
        $updateUser-> update($userdata);

        // Récupérer le client lié à l'utilisateur
        $updateClient = $updateUser->client; // Doit être une relation définie dans le modèle User

        if ($updateClient) {
            $updateClient->update($clientdta);
        }

        return redirect()->route('profile')->with('success', 'Profil mis à jour avec succès !');
    }
    
    public function password(){

        return view('admin.profile.passwordChange');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
        $user = User::findOrFail(Auth::user()->id);
        // $user = Auth::user();
    
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Le mot de passe actuel est incorrect.');
        }
        if ($request->new_password !== $request->new_password_confirmation) {
            return back()->with('error', 'La confirmation du nouveau mot de passe ne correspond pas.');
        }
        // $user->update([
        //     'password' => Hash::make($request->new_password),
        // ]);

        $user->password = Hash::make($request->new_password);
        $user->save();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
