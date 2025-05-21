<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 
        for($i = 0; $i < 50; $i++)
        {
            Client::create([
                'nom' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'telephone' => fake()->phoneNumber(),
                'adresse' => fake()->address(),
            ]);
        }
    }
}