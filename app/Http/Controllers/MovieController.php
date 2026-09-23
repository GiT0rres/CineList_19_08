<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

// Substitui as chamadas supabase.from("movies").select/insert/update/delete.
// Renderiza views Blade em vez de retornar JSON.
class MovieController extends Controller
{
    public const GENEROS = [
        'Ação', 'Aventura', 'Comédia', 'Drama', 'Ficção Científica',
        'Terror', 'Fantasia', 'Romance', 'Suspense', 'Animação', 'Documentário',
    ];

    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q', ''));
        $movies = Movie::orderByDesc('created_at')->get();

        if ($search !== '') {
            $needle = mb_strtolower($search);
            $movies = $movies->filter(function (Movie $movie) use ($needle) {
                $haystack = mb_strtolower(implode(' ', [
                    $movie->title,
                    $movie->director,
                    implode(' ', $movie->genres ?? []),
                    $movie->created_by_name,
                ]));

                return str_contains($haystack, $needle);
            });
        }

        return view('movies.index', [
            'movies' => $movies,
            'search' => $search,
            'totalGeneros' => $movies->flatMap(fn (Movie $m) => $m->genres ?? [])->unique()->count(),
            'totalDiretores' => $movies->pluck('director')->filter()->unique()->count(),
        ]);
    }

    public function create(): View
    {
        return view('movies.form', [
            'movie' => null,
            'generos' => self::GENEROS,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        $request->user()->movies()->create([
            ...$data,
            'created_by_name' => $request->user()->display_name,
        ]);

        return redirect()->route('dashboard')->with('success', 'Filme cadastrado!');
    }

    public function edit(Movie $movie): View
    {
        return view('movies.form', [
            'movie' => $movie,
            'generos' => self::GENEROS,
        ]);
    }

    public function update(Request $request, Movie $movie): RedirectResponse
{
    if ($movie->user_id !== $request->user()->id) {
        abort(403);
    }

    $movie->update($this->validated($request));

    return redirect()
        ->route('dashboard')
        ->with('success', 'Filme atualizado!');
}

public function destroy(Request $request, Movie $movie): RedirectResponse
{
    if ($movie->user_id !== $request->user()->id) {
        abort(403);
    }

    $movie->delete();

    return redirect()
        ->route('dashboard')
        ->with('success', 'Filme excluído.');
}

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'director' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'integer', 'min:1888', 'max:2200'],
            'genres' => ['array'],
            'genres.*' => ['string', 'in:'.implode(',', self::GENEROS)],
            'synopsis' => ['nullable', 'string'],
            'poster_url' => ['nullable', 'url', 'max:2048'],
        ]);
    }
}
