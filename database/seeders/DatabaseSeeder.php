<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;
use App\Models\Client;
use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Produit;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AddUsersSeeder::class,
        ]);
        
        // CommandeTableSeeder::class,
        Client::factory(50)->create();
        Commande::factory(50)->create();
        Categorie::factory(50)->create();
        Produit::factory(50)->create();
        LigneCommande::factory(50)->create();
    }
}
