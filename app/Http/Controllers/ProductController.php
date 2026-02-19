<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $user = User::first();
        $products = Product::all();

        return view('loja', [
            'tenantName' => tenant('id'),
            'userName'   => $user ? $user->name : 'Visitante',
            'userEmail'  => $user ? $user->email : 'Nenhum e-mail',
            'products'   => $products,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);


        Product::create($validated);

        return back()->with('success', 'Produto cadastrado com sucesso!');
    }
}
