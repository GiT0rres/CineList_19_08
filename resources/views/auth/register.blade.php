<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Criar conta | CineList</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  <div style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px;">
    <div class="card" style="width:100%;max-width:380px;padding:28px;">
      <strong style="font-family:Georgia,serif;font-size:22px;display:block;margin-bottom:20px;">CineList</strong>

      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
          <label for="name">Nome</label>
          <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
          @error('name') <div class="field-error">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
          <label for="email">E-mail</label>
          <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required>
          @error('email') <div class="field-error">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
          <label for="password">Senha</label>
          <input class="form-control" type="password" id="password" name="password" minlength="6" required>
          @error('password') <div class="field-error">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
          <label for="password_confirmation">Confirmar senha</label>
          <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" minlength="6" required>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;">Cadastrar</button>
      </form>

      <p class="muted" style="text-align:center;font-size:13px;margin-top:16px;">
        Já tem conta? <a href="{{ route('login') }}" style="text-decoration:underline;">Entrar</a>
      </p>
    </div>
  </div>
</body>
</html>
