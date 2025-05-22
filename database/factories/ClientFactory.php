<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [
        //     //
        //        'nom' => fake()->name(),
        //         'telephone' => fake()->phoneNumber(),
        //         'adresse' => fake()->address(),
        // ];
        return [
        'nom' => fake()->name(),  // Par défaut
        'telephone' => $this->fakerfake()->phoneNumber(),
        'adresse' => fake()->address(),
        'user_id' => null,
    ];
    }
}
