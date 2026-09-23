<?php

namespace App\Policies;

use App\Models\Movie;
use App\Models\User;

// Espelha as policies SQL:
//   "Usuario edita seus filmes"  / "Usuario exclui seus filmes"
class MoviePolicy
{
    public function update(User $user, Movie $movie): bool
    {
        return $user->id === $movie->user_id;
    }

    public function delete(User $user, Movie $movie): bool
    {
        return $user->id === $movie->user_id;
    }
}
