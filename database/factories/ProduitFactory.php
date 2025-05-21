<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categorie;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produit>
 */
class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            "nom" => fake()->word(),
            "prix_unitaire" => fake()->randomFloat(2, 1, 100),
            "description" => fake()->paragraph(),
            "stock" => fake()->numberBetween(0, 100),
            "categorie_id" =>Categorie::inRandomOrder()->first()->id, // Assurez-vous que la catégorie existe
        ];
    }
}
