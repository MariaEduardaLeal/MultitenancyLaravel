<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProductController extends Controller
{
    public function index()
    {
        $user = User::first();

        return view('loja', [
            'tenantName' => tenant('id'),
            'userName'   => $user ? $user->name : 'Visitante',
            'userEmail'  => $user ? $user->email : 'Nenhum e-mail',
        ]);
    }
}
