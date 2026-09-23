<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'CineList')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  <div class="app-shell">
    <aside class="sidebar">
      <div>
        <a href="{{ route('dashboard') }}" style="display:flex;align-items:center;gap:10px;margin-bottom:28px;">
          <strong style="font-family:Georgia,serif;font-size:22px;">CineList</strong>
        </a>
        <nav>
          <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
          <a href="{{ route('movies.create') }}" class="{{ request()->routeIs('movies.create') ? 'active' : '' }}">+ Novo Filme</a>
        </nav>
      </div>
      <div>
        <p style="font-size:13px;opacity:.7;margin-bottom:10px;font-weight:bold;">{{ auth()->user()->display_name }}</p>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-outline btn-sm" style="width:100%;color:#fff;border-color:rgba(255,255,255,.2);">Sair</button>
        </form>
      </div>
    </aside>

    <main class="main">
      <div class="container" style="padding:0;">
        @if (session('success'))
          <div class="flash flash-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any() && !$errors->has('email') && !$errors->has('password'))
          <div class="flash flash-error">Verifique os campos destacados no formulário.</div>
        @endif

        @yield('content')
      </div>
    </main>
  </div>
</body>
</html>
