<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CineList — Catálogo de filmes com login</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<header class="site-header">
    <a href="{{ route('home') }}" class="brand">
        <span class="brand-icon">🎬</span>
        <strong>CineList</strong>
    </a>

    <a href="{{ route('login') }}" class="btn btn-outline">
        Entrar
    </a>
</header>

  <main class="container" style="padding-bottom:80px;padding-top:20px;">
    <p class="muted" style="letter-spacing:.15em;text-transform:uppercase;font-size:12px;font-weight:700;">Catálogo de filmes</p>
    <h1 style="font-size:48px;line-height:1.05;max-width:720px;">
      Gerencie seu acervo de cinema de forma simples e rápida.
    </h1>
    <p class="muted" style="max-width:560px;">
      Faça login, cadastre seus filmes e mantenha tudo em uma tabela organizada.
      Cada filme guarda automaticamente o nome do usuário que o cadastrou.
    </p>
    <div style="display:flex;gap:12px;margin-top:24px;">
      <a href="{{ route('register') }}" class="btn btn-primary">Criar conta gratuitamente</a>
      <a href="{{ route('login') }}" class="btn btn-outline">Já tenho conta</a>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px;margin-top:56px;">
      <div class="card" style="padding:20px;">
        <h2 style="font-size:16px;">Cadastro completo</h2>
        <p class="muted" style="font-size:14px;">Título, diretor, ano, gêneros e sinopse.</p>
      </div>
      <div class="card" style="padding:20px;">
        <h2 style="font-size:16px;">Criar e editar juntos</h2>
        <p class="muted" style="font-size:14px;">A mesma tela para novo e edição de filme.</p>
      </div>
      <div class="card" style="padding:20px;">
        <h2 style="font-size:16px;">Exclusão segura</h2>
        <p class="muted" style="font-size:14px;">Um aviso de confirmação antes de apagar.</p>
      </div>
    </div>
  </main>
</body>
</html>
