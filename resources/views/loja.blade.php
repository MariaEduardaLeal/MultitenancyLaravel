<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Loja: {{ ucfirst($tenantName) }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            /* Usamos a cor que a Eduarda configurou no Tenant Model */
            --cor-da-loja: {{ tenant('primary_color') ?? '#3b82f6' }};
        }
        .bg-theme { background-color: var(--cor-da-loja); }
        .text-theme { color: var(--cor-da-loja); }
        .border-theme { border-color: var(--cor-da-loja); }
    </style>
</head>
<body class="bg-gray-50 p-8">

    <div class="max-w-4xl mx-auto">
        <header class="flex justify-between items-center mb-10">
            <h1 class="text-3xl font-bold text-theme">{{ ucfirst($tenantName) }}.com</h1>
            <a href="{{ route('settings.edit') }}" class="text-sm text-gray-500 hover:underline">Configurações</a>
        </header>

        @if($products->isEmpty())
            <div class="bg-white p-8 rounded-xl shadow-md border-2 border-dashed border-theme text-center">
                <h2 class="text-2xl font-bold mb-4">Sua loja ainda está vazia! 📦</h2>
                <p class="text-gray-600 mb-8">Cadastre seu primeiro produto para começar a vender.</p>

                <form action="{{ route('products.store') }}" method="POST" class="max-w-md mx-auto text-left">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nome do Produto</label>
                        <input type="text" name="name" required class="w-full mt-1 p-2 border rounded-md outline-theme">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Preço (R$)</label>
                        <input type="number" name="price" step="0.01" required class="w-full mt-1 p-2 border rounded-md outline-theme">
                    </div>
                    <button type="submit" class="w-full bg-theme text-white font-bold py-3 rounded-md hover:opacity-90 transition-opacity">
                        Cadastrar Meu Primeiro Produto
                    </button>
                </form>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                        <div class="h-40 bg-gray-100 rounded mb-4 flex items-center justify-center text-gray-400">Sem foto</div>
                        <h3 class="font-bold text-lg">{{ $product->name }}</h3>
                        <p class="text-theme font-bold text-xl mt-2">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                        <button class="w-full mt-4 border-theme border text-theme py-2 rounded hover:bg-theme hover:text-white transition-all">
                            Adicionar ao Carrinho
                        </button>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

</body>
</html>
