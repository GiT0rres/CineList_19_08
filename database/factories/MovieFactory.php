<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Movie;

class MovieFactory extends Factory
{
    protected $model = Movie::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'created_by_name' => fake()->name(),
            'title' => fake()->sentence(3),
            'director' => fake()->name(),
            'year' => fake()->numberBetween(1970, 2026),
            'genres' => [fake()->randomElement([
                'Ação',
                'Aventura',
                'Comédia',
                'Drama',
                'Ficção Científica',
                'Terror',
            ])],
            'synopsis' => fake()->paragraph(),
            'poster_url' => null,
        ];
    }
}
