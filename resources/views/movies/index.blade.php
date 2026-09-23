@extends('layouts.app')

@section('title', 'Filmes cadastrados | CineList')

@section('content')
<div class="dashboard">

    {{-- CABEÇALHO --}}
    <div class="dashboard-header">
        <div>
            <span class="page-eyebrow">CATÁLOGO DE FILMES</span>
            <h1>Olá, {{ auth()->user()->display_name }}!</h1>
            <p class="muted">
                Gerencie seu catálogo de filmes de forma simples e rápida.
            </p>
        </div>

        <a href="{{ route('movies.create') }}" class="btn btn-primary">
            <span class="btn-icon">+</span>
            Novo Filme
        </a>
    </div>

    {{-- ESTATÍSTICAS --}}
    <div class="stat-grid">

        <div class="stat-card">
            <div class="stat-icon">🎬</div>
            <div>
                <span class="stat-label">Filmes cadastrados</span>
                <strong class="stat-value">{{ $movies->count() }}</strong>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">🎥</div>
            <div>
                <span class="stat-label">Diretores</span>
                <strong class="stat-value">{{ $totalDiretores }}</strong>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">🏷️</div>
            <div>
                <span class="stat-label">Gêneros</span>
                <strong class="stat-value">{{ $totalGeneros }}</strong>
            </div>
        </div>

    </div>

    {{-- TABELA --}}
    <section class="movies-card">

        <div class="movies-toolbar">

            <div>
                <h2>Meus filmes</h2>
                <span class="movies-count">
                    {{ $movies->count() }}
                    {{ $movies->count() == 1 ? 'filme cadastrado' : 'filmes cadastrados' }}
                </span>
            </div>

            <form method="GET" action="{{ route('dashboard') }}" class="search-box">
                <span class="search-icon">⌕</span>

                <input
                    type="text"
                    name="q"
                    value="{{ $search }}"
                    placeholder="Buscar filme, diretor ou gênero..."
                >
            </form>

        </div>

        @if ($movies->isEmpty())

            <div class="empty-state">

                <div class="empty-icon">🎬</div>

                <h3>
                    {{ $search
                        ? 'Nenhum filme encontrado'
                        : 'Seu catálogo está vazio'
                    }}
                </h3>

                <p>
                    {{ $search
                        ? 'Tente pesquisar por outro nome, diretor ou gênero.'
                        : 'Comece adicionando seu primeiro filme ao CineList.'
                    }}
                </p>

                @if (!$search)
                    <a href="{{ route('movies.create') }}" class="btn btn-primary">
                        + Cadastrar primeiro filme
                    </a>
                @endif

            </div>

        @else

            <div class="table-wrapper">

                <table class="movies-table">

                    <thead>
                        <tr>
                            <th class="movie-column">FILME</th>
                            <th>DIRETOR</th>
                            <th>ANO</th>
                            <th>GÊNEROS</th>
                            <th>CADASTRADO POR</th>
                            <th class="actions-column">AÇÕES</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($movies as $movie)

                            <tr>

                                {{-- FILME --}}
                                <td>
                                    <div class="movie-info">

                                        <div class="movie-poster">
                                            @if ($movie->poster_url)
                                                <img
                                                    src="{{ $movie->poster_url }}"
                                                    alt="{{ $movie->title }}"
                                                >
                                            @else
                                                <span>🎬</span>
                                            @endif
                                        </div>

                                        <div class="movie-name">
                                            <strong>{{ $movie->title }}</strong>

                                            @if ($movie->synopsis)
                                                <span>
                                                    {{ \Illuminate\Support\Str::limit($movie->synopsis, 55) }}
                                                </span>
                                            @endif
                                        </div>

                                    </div>
                                </td>

                                {{-- DIRETOR --}}
                                <td>
                                    <span class="table-main-text">
                                        {{ $movie->director ?: 'Não informado' }}
                                    </span>
                                </td>

                                {{-- ANO --}}
                                <td>
                                    @if ($movie->year)
                                        <span class="year-badge">
                                            {{ $movie->year }}
                                        </span>
                                    @else
                                        <span class="muted">—</span>
                                    @endif
                                </td>

                                {{-- GÊNEROS --}}
                                <td>
                                    <div class="genre-list">

                                        @if (empty($movie->genres))

                                            <span class="muted">—</span>

                                        @else

                                            @foreach (array_slice($movie->genres, 0, 2) as $genre)
                                                <span class="genre-tag">
                                                    {{ $genre }}
                                                </span>
                                            @endforeach

                                            @if (count($movie->genres) > 2)
                                                <span class="genre-more">
                                                    +{{ count($movie->genres) - 2 }}
                                                </span>
                                            @endif

                                        @endif

                                    </div>
                                </td>

                                {{-- USUÁRIO --}}
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar">
                                            {{ strtoupper(substr($movie->created_by_name, 0, 1)) }}
                                        </div>

                                        <span>
                                            {{ $movie->created_by_name }}
                                        </span>
                                    </div>
                                </td>

                                {{-- AÇÕES --}}
                                <td>

                                    <div class="table-actions">

                                        <a
                                            href="{{ route('movies.edit', $movie) }}"
                                            class="action-btn edit"
                                            title="Editar filme"
                                        >
                                            ✎
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('movies.destroy', $movie) }}"
                                            onsubmit="return confirm('Tem certeza que quer deletar o filme &quot;{{ $movie->title }}&quot;?');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-btn delete"
                                                title="Excluir filme"
                                            >
                                                ×
                                            </button>
                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </section>

</div>
@endsection