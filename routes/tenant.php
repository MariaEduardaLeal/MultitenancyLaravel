<?php

declare(strict_types=1);

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
    Route::get('/', function () {
        // Buscamos o usuário que criamos via Tinker
        $user = \App\Models\User::first();

        return view('loja', [
            'tenantName' => tenant('id'),
            'userName' => $user ? $user->name : 'Visitante',
            'userEmail' => $user ? $user->email : 'Nenhum e-mail cadastrado',
        ]);
    });
});
