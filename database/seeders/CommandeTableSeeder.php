<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Commande;
use App\Models\Client;

class CommandeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 50; $i++) {
            Commande::create([
                'client_id' => Client::inRandomOrder()->first()->id, 
                'date_commande' => fake()->dateTimeBetween('-2 years', 'now')->format('Y-m-d'), // ✅ Correction ici
                // 'date_commande' => fake()->date('Y-m-d'),             // ✅ Correction de la date (Y au lieu de y)
                'etat_commande' => fake()->randomElement(['en cour', 'terminée', 'annulée']),
            ]);
        }
    }
}
