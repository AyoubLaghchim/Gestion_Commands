<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;

class AddUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        User::create(
            [
                'id'=>'001',
                'nom'=> 'Ayoub Laghchim',
                'email'=> 'ayoublaghchim77@gmail.com',
                'password'=> '123454321',
                'role'=> 'admin',
            ]);
        Client::create(
            [
                'nom'=> 'Ayoub Laghchim',
                'email'=> 'ayoublaghchim77@gmail.com',
                'telephone'=> '0657002286',
                'adresse'=> 'Marrakech',
                'user_id' => '001'
            ]);
        
    }
}
