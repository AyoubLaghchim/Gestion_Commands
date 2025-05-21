<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Commande;
use App\Models\Produit;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LigneCommande>
 */
class LigneCommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "commande_id" => Commande::inRandomOrder()->first()->id,
            "produit_id" => Produit::inRandomOrder()->first()->id,
            "quantite" => fake()->numberBetween(1, 10),
        ];
    }
}
