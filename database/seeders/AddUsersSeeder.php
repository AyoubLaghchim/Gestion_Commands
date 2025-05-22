<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Client;

class AddUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création d’un utilisateur
        $user = User::create([
            'nom' => 'Ayoub Laghchim',
            'email' => 'ayoublaghchim77@gmail.com',
            'password' => Hash::make('123454321'),
            'role' => 'admin',
        ]);
        // Création du client associé
        Client::create([
            'nom' => 'Ayoub Laghchim',
            'telephone' => '0657002286',
            'adresse' => 'Marrakech',
            'user_id' => $user->id, // Récupération de l’ID généré automatiquement
        ]);

    }
}
