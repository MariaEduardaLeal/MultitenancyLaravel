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

Route::middleware([
    'web',
    Stancl\Tenancy\Middleware\InitializeTenancyByDomain::class,
    Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::post('/produtos', [ProductController::class, 'store'])->name('products.store');

    Route::get('/carrinho', [CartController::class, 'index'])->name('cart.index');
    Route::post('/carrinho/adicionar/{product}', [CartController::class, 'store']);

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

    Route::get('/configuracoes', function () {
        return view('tenant.settings');
    })->name('settings.edit');


    Route::post('/configuracoes', function (Illuminate\Http\Request $request) {
        $color = $request->input('primary_color');

        $updateData = ['primary_color' => $color];

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $updateData['logo_url'] = $path;
        }

        tenant()->update($updateData);

        return back()->with('success', 'Loja decorada e logo atualizada!');
    })->name('settings.update');
});
