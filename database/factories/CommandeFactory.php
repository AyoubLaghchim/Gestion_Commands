<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commande>
 */
class CommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => Client::inRandomOrder()->first()->id, 
            'date_commande' => fake()->dateTimeBetween('-2 years', 'now')->format('Y-m-d'), // ✅ Correction ici
            'etat_commande' => fake()->randomElement(['en cour', 'terminée', 'annulée']),
        ];
    }
}
