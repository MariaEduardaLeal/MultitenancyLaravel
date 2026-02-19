<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | {{ config('app.name', 'Fábrica de Sites') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased">

    <div class="max-w-6xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

        <header class="mb-12 text-center">
            <h1 class="text-4xl font-extrabold text-blue-600 mb-2">Fábrica de Sites</h1>
            <p class="text-gray-600">Gerencie sua plataforma SaaS e crie novos ambientes instantaneamente.</p>
        </header>

        <section class="bg-white shadow-sm border border-gray-200 rounded-xl p-8 mb-10">
            <h2 class="text-xl font-bold mb-6 flex items-center">
                <span class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-0h6m-6 0H6" />
                    </svg>
                </span>
                Provisionar Novo Inquilino (Tenant)
            </h2>

            <form action="{{ route('shops.store') }}" method="POST" class="flex flex-col md:flex-row gap-4">
                @csrf
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" name="id" placeholder="Nome da loja (ex: eduardo)" required
                            class="w-full pl-4 pr-32 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400 font-medium">
                            .localhost
                        </div>
                    </div>
                    <input type="hidden" name="domain" value="localhost">
                </div>

                <input type="file" name="logo">

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition-colors shadow-lg shadow-blue-200 active:transform active:scale-95">
                    Criar Loja Agora
                </button>
            </form>

            @if(session('success'))
                <div class="mt-4 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {!! session('success') !!}
                </div>
            @endif
        </section>

        <section class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
                <h2 class="text-xl font-bold text-gray-800">Gerenciamento de Clientes (Tenants)</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-xs uppercase text-gray-500 font-semibold bg-gray-50 border-b border-gray-200">
                            <th class="px-8 py-4">ID da Loja</th>
                            <th class="px-6 py-4">Domínio do Cliente</th>
                            <th class="px-6 py-4">E-mail do Administrador</th>
                            <th class="px-6 py-4 text-center">Usuários</th>
                            <th class="px-8 py-4 text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($tenants as $tenant)
                        <tr class="hover:bg-blue-50/30 transition-colors">
                            <td class="px-8 py-5 font-medium text-gray-900 capitalize">{{ $tenant->id }}</td>
                            <td class="px-6 py-5">
                                <a href="http://{{ $tenant->domains->first()->domain }}:8000" target="_blank"
                                   class="text-blue-600 hover:text-blue-800 flex items-center group font-medium">
                                    {{ $tenant->domains->first()->domain }}
                                    <svg class="h-4 w-4 ml-1 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </td>
                            <td class="px-6 py-5 text-gray-600">
                                {{ $tenant->admin_email ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ $tenant->user_count }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <button class="text-sm font-semibold text-red-600 hover:text-red-800 transition-colors">
                                    Suspender
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($tenants->isEmpty())
                <div class="py-20 text-center text-gray-400">
                    Nenhuma loja cadastrada ainda. Use o formulário acima para começar!
                </div>
            @endif
        </section>

        <footer class="mt-12 text-center text-gray-400 text-sm">
            &copy; 2026 - Desenvolvido por Eduarda Leal.
        </footer>
    </div>

</body>
</html>
