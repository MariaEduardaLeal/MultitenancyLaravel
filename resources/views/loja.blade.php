<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Loja: {{ ucfirst($tenantName) }}</title>
    <style>
        :root {

            /* O PHP pega a cor da "gaveta" e entrega para o CSS */
            --cor-da-loja: {
                    {
                    tenant('primary_color') ?? '#3b82f6'
                }
            }

            ;
        }

        .botao-com-cor {
            background-color: var(--cor-da-loja);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
        }

        h1 {
            color: var(--cor-da-loja);
        }
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
