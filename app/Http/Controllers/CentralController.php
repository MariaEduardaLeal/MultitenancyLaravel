<?php


namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use \App\Models\User;

class CentralController extends Controller
{
    public function index()
    {
        $tenants = Tenant::all()->map(function ($tenant) {
            $tenant->user_count = $tenant->run(function () {
                return User::count();
            });

            $tenant->admin_email = $tenant->run(function () {
                return User::first()?->email;
            });

            return $tenant;
        });

        return view('welcome', compact('tenants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|alpha_dash|unique:tenants,id',
            'domain' => 'required|unique:domains,domain'
        ]);

        // 1. Cria o Tenant (e o banco MySQL automaticamente)
        $tenant = Tenant::create(['id' => $validated['id']]);

        // 2. Cria o Domínio
        $tenant->domains()->create([
            'domain' => $validated['id'] . '.' . $validated['domain']
        ]);

        // 3. MÁGICA: Cria o primeiro usuário dentro do banco da nova loja
        $tenant->run(function () {
            \App\Models\User::create([
                'name' => 'Administrador da Loja',
                'email' => 'admin@loja.com',
                'password' => bcrypt('senha123'),
            ]);
        });

        return back()->with('success', "Loja criada! Acesse: http://{$validated['id']}.{$validated['domain']}:8000");
    }
}
