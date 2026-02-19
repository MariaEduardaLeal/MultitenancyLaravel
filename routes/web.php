<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentralController;

// Envolvemos as rotas em um loop que lê seus domínios centrais do config/tenancy.php
foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', [CentralController::class, 'index']);
        Route::post('/create-shop', [CentralController::class, 'store'])->name('shops.store');
    });
}
