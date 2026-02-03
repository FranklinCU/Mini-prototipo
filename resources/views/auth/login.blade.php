<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f7fb; color: #111; }
        .wrap { max-width: 400px; margin: 80px auto; padding: 0 16px; }
        .card { background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 8px 20px rgba(0,0,0,0.06); }
        input { width: 100%; padding: 10px; border: 1px solid #d7dbe6; border-radius: 8px; margin-bottom: 12px; }
        .btn-main { background: #2e6bff; color: #fff; border: 0; padding: 10px 14px; border-radius: 8px; cursor: pointer; width: 100%; }
        .error { background: #ffe0e0; color: #b91c1c; padding: 10px 16px; border-radius: 8px; margin-bottom: 12px; }
    </style>
</head>
<body>
    <div class="wrap">
        <form class="card" method="POST" action="{{ route('login') }}">
            @csrf
            <h2>Iniciar sesión</h2>
            @if($errors->any())
                <div class="error">{{ $errors->first() }}</div>
            @endif
            <input type="text" name="username" placeholder="Usuario" required autofocus>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button class="btn-main" type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
