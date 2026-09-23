<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::updateOrCreate(
            [
                'email' => 'demo@cinelist.test',
            ],
            [
                'display_name' => 'Usuário Demo',
                'password' => Hash::make('password'),
            ]
        );

        Movie::factory()->count(5)->create([
            'user_id' => $user->id,
        ]);
    }
}
