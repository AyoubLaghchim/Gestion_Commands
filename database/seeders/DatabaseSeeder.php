<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Categorie;
use App\Models\Produit;
use App\Models\LigneCommande;

class DatabaseSeeder extends Seeder
{
    public function run(): void
{
    // Supprime les autres appels au AddUsersSeeder, tu créeras les users ici
    // $users = User::factory(50)->create();

    // $users->each(function ($user) {
    //     Client::factory()->create([
    //         'user_id' => $user->id,
    //         'nom' => $user->name,  // Le client reprend le nom du user
    //         // Ajoute d'autres champs si besoin pour être cohérent
    //     ]);
    // });
    
    Commande::factory(20)->create();
    Categorie::factory(20)->create();
    Produit::factory(20)->create();
    LigneCommande::factory(20)->create();
}
}
