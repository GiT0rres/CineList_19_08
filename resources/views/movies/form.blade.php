@extends('layouts.app')

@section('title', ($movie ? 'Editar Filme' : 'Novo Filme').' | CineList')

@section('content')
  <div style="max-width:640px;margin:0 auto;">
    <a href="{{ route('dashboard') }}" class="muted" style="font-size:13px;">&larr; Voltar</a>

    <h1 style="font-size:32px;margin-top:14px;">{{ $movie ? 'Editar Filme' : 'Novo Filme' }}</h1>
    <p class="muted">
      {{ $movie ? 'Atualize os dados do filme cadastrado.' : 'Preencha os dados do filme para adicioná-lo ao catálogo.' }}
    </p>

    <form method="POST" action="{{ $movie ? route('movies.update', $movie) : route('movies.store') }}" class="card" style="padding:24px;margin-top:20px;">
      @csrf
      @if ($movie) @method('PUT') @endif

      <div class="form-group">
        <label for="title">Título</label>
        <input class="form-control" type="text" id="title" name="title" value="{{ old('title', $movie->title ?? '') }}" required>
        @error('title') <div class="field-error">{{ $message }}</div> @enderror
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
        <div class="form-group">
          <label for="director">Diretor</label>
          <input class="form-control" type="text" id="director" name="director" value="{{ old('director', $movie->director ?? '') }}">
        </div>
        <div class="form-group">
          <label for="year">Ano</label>
          <input class="form-control" type="number" id="year" name="year" min="1888" max="2200" value="{{ old('year', $movie->year ?? '') }}">
          @error('year') <div class="field-error">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="form-group">
        <label>Gêneros</label>
        @php $selected = old('genres', $movie->genres ?? []); @endphp
        <div class="genre-picker">
          @foreach ($generos as $genero)
            <label class="badge {{ in_array($genero, $selected) ? 'badge-on' : '' }}">
              <input type="checkbox" name="genres[]" value="{{ $genero }}" {{ in_array($genero, $selected) ? 'checked' : '' }}
                     onchange="this.parentElement.classList.toggle('badge-on', this.checked)">
              {{ $genero }}
            </label>
          @endforeach
        </div>
      </div>

      <div class="form-group">
        <label for="poster_url">URL do pôster (opcional)</label>
        <input class="form-control" type="url" id="poster_url" name="poster_url" value="{{ old('poster_url', $movie->poster_url ?? '') }}" placeholder="https://...">
        @error('poster_url') <div class="field-error">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="synopsis">Sinopse</label>
        <textarea class="form-control" id="synopsis" name="synopsis" rows="4">{{ old('synopsis', $movie->synopsis ?? '') }}</textarea>
      </div>

      <p class="muted" style="font-size:13px;">
        Cadastrado por: <strong>{{ $movie->created_by_name ?? auth()->user()->display_name }}</strong> (adicionado automaticamente)
      </p>

      <div style="display:flex;gap:12px;margin-top:8px;">
        <button type="submit" class="btn btn-primary">{{ $movie ? 'Salvar alterações' : 'Cadastrar filme' }}</button>
        <a href="{{ route('dashboard') }}" class="btn btn-outline">Cancelar</a>
      </div>
    </form>
  </div>
@endsection
