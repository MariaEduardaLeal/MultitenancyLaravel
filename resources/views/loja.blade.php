<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Loja: {{ ucfirst($tenantName) }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --cor-da-loja: {{ tenant('primary_color') ?? '#3b82f6' }};
        }

        .bg-theme {
            background-color: var(--cor-da-loja) !important;
        }

        .text-theme {
            color: var(--cor-da-loja) !important;
        }

        .border-theme {
            border-color: var(--cor-da-loja) !important;
        }
    </style>
</head>

<body class="bg-gray-50 p-8">

    <div class="max-w-4xl mx-auto">
        <header class="flex justify-between items-center mb-10">
            <div class="flex items-center gap-4">
                @if(tenant('logo_url'))
                <img src="{{ tenant_asset(tenant('logo_url')) }}"
                    alt="Logo {{ ucfirst($tenantName) }}"
                    class="h-12 w-auto object-contain">
                @endif
                <h1 class="text-3xl font-bold text-theme">{{ ucfirst($tenantName) }}.com</h1>
            </div>
            <div class="flex gap-4 items-center">
                @unless($products->isEmpty())
                <button onclick="document.getElementById('modalProduto').classList.remove('hidden')"
                    class="bg-theme text-black px-4 py-2 rounded-lg font-bold shadow-md hover:brightness-90 transition-all">
                    + Novo Produto
                </button>
                @endunless
                <a href="{{ route('settings.edit') }}" class="text-sm text-gray-500 hover:underline">Configurações</a>
            </div>
        </header>

        @if($products->isEmpty())
        <div class="bg-white p-8 rounded-xl shadow-md border-2 border-dashed border-theme text-center">
            <h2 class="text-2xl font-bold mb-4">Sua loja ainda está vazia! 📦</h2>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="max-w-md mx-auto text-left">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nome do Produto</label>
                    <input type="text" name="name" required class="w-full mt-1 p-2 border rounded-md outline-theme">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Preço (R$)</label>
                    <input type="number" name="price" step="0.01" required class="w-full mt-1 p-2 border rounded-md outline-theme">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Imagem do Produto</label>
                    <input type="file" name="image" class="w-full mt-1">
                </div>
                <button type="submit" class="w-full bg-theme text-white font-bold py-3 rounded-md">Cadastrar Primeiro Produto</button>
            </form>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($products as $product)
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                <div class="h-40 bg-gray-100 rounded mb-4 overflow-hidden">
                    @if($product->image_url)
                    <img src="{{ $product->image_url ? tenant_asset($product->image_url) : asset('default.png') }}">
                    @else
                    <div class="flex items-center justify-center h-full text-gray-400">Sem foto</div>
                    @endif
                </div>
                <h3 class="font-bold text-lg">{{ $product->name }}</h3>
                <p class="text-theme font-bold text-xl mt-2">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                <button class="w-full mt-4 border-theme border text-theme py-2 rounded hover:bg-theme hover:text-white transition-all">
                    Adicionar ao Carrinho
                </button>
            </div>
            @endforeach
        </div>
        @endif

        <div id="modalProduto" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-xl shadow-2xl max-w-lg w-full p-8 relative">
                <button onclick="document.getElementById('modalProduto').classList.add('hidden')"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>

                <h2 class="text-2xl font-bold mb-6 text-gray-800">Novo Produto</h2>

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nome</label>
                        <input type="text" name="name" required class="w-full p-2 border rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Preço</label>
                        <input type="number" name="price" step="0.01" required class="w-full p-2 border rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Imagem</label>
                        <input type="file" name="image" class="w-full mt-1">
                    </div>
                    <button type="submit" class="w-full bg-theme text-white font-bold py-3 rounded-md">Salvar Produto</button>
                </form>
            </div>
        </div>

    </div>
</body>

</html>
