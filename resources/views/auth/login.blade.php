<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Entrar | CineList</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  <div style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px;">
    <div class="card" style="width:100%;max-width:380px;padding:28px;">
      <strong style="font-family:Georgia,serif;font-size:22px;display:block;margin-bottom:20px;">CineList</strong>

      @if (session('success'))
        <div class="flash flash-success">{{ session('success') }}</div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
          <label for="email">E-mail</label>
          <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
          @error('email') <div class="field-error">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
          <label for="password">Senha</label>
          <input class="form-control" type="password" id="password" name="password" required>
          @error('password') <div class="field-error">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;">Entrar</button>
      </form>

      <p class="muted" style="text-align:center;font-size:13px;margin-top:16px;">
        Não tem conta? <a href="{{ route('register') }}" style="text-decoration:underline;">Cadastre-se</a>
      </p>
    </div>
  </div>
</body>
</html>
