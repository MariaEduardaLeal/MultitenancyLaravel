<?php

declare(strict_types=1);

use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

// routes/tenant.php

Route::middleware([
    'web',
    Stancl\Tenancy\Middleware\InitializeTenancyByDomain::class,
    Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains::class,
])->group(function () {

    // Página Inicial / Produtos
    Route::get('/', [ProductController::class, 'index'])->name('products.index');

    // Carrinho
    Route::get('/carrinho', [CartController::class, 'index'])->name('cart.index');
    Route::post('/carrinho/adicionar/{product}', [CartController::class, 'store']);

    // Autenticação do Cliente da Loja
    // Como você moveu a tabela 'users' para o tenant, o Auth padrão funciona aqui!
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

    Route::get('/configuracoes', function () {
        return view('tenant.settings');
    })->name('settings.edit');

    // BOTÃO DE SALVAR
    // routes/tenant.php

    Route::post('/configuracoes', function (Illuminate\Http\Request $request) {
        // 1. Pegamos a cor
        $color = $request->input('primary_color');

        // 2. Criamos um array com os dados para atualizar
        $updateData = ['primary_color' => $color];

        // 3. Onde você deve colocar o código da logo:
        if ($request->hasFile('logo')) {
            // O Laravel salva na pasta privada desta loja automaticamente!
            // O 'store' cria o arquivo e o 'tenant_asset' gera o caminho correto
            $path = $request->file('logo')->store('logos', 'public');
            $updateData['logo_url'] = $path;
        }

        // 4. Atualizamos a "gaveta" data do inquilino atual
        tenant()->update($updateData);

        return back()->with('success', 'Loja decorada e logo atualizada!');
    })->name('settings.update');
});
