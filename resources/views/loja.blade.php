<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Loja: {{ ucfirst($tenantName) }}</title>
    <style>
        body { font-family: sans-serif; padding: 50px; text-align: center; background: #f4f4f4; }
        .card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); display: inline-block; }
        h1 { color: #333; }
        span { color: #666; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Bem-vindo à {{ ucfirst($tenantName) }}.com</h1>
        <p>Este é um site renderizado via <strong>SSR</strong>.</p>
        <hr>
        <p>Primeiro cliente cadastrado nesta loja:</p>
        <strong>{{ $userName }}</strong><br>
        <span>{{ $userEmail }}</span>
    </div>
</body>
</html>
