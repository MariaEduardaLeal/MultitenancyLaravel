<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações | {{ ucfirst(tenant('id')) }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 py-12 px-4">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden p-8 border border-gray-200">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Decore sua Loja 🖌️</h1>
            <a href="/" class="text-sm text-blue-600 hover:underline">Ver Loja</a>
        </div>

        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cor Principal da Marca</label>
                <div class="flex items-center gap-4">
                    <input type="color" name="primary_color" value="{{ tenant('primary_color') ?? '#3b82f6' }}"
                           class="h-12 w-12 rounded border border-gray-300 cursor-pointer">
                    <span class="text-gray-500 text-sm italic">Esta cor será usada em botões e títulos.</span>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Logotipo da Loja</label>
                @if(tenant('logo_url'))
                    <div class="mb-4 p-2 border rounded-lg bg-gray-50 flex justify-center">
                        <img src="{{ asset('storage/' . tenant('logo_url')) }}" class="h-16 object-contain">
                    </div>
                @endif
                <input type="file" name="logo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition-all shadow-md active:scale-95">
                Salvar Configurações
            </button>
        </form>

        @if(session('success'))
            <div class="mt-6 p-3 bg-green-100 border-l-4 border-green-500 text-green-700 text-sm">
                {{ session('success') }}
            </div>
        @endif
    </div>
</body>
</html>
