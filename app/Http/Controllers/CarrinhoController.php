<?php

namespace App\Http\Controllers;

use App\Services\CarrinhoService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Exception;

class CarrinhoController extends Controller
{
    /**
     * Método principal para lidar com a requisição.
     * O retorno deve idealmente utilizar API Resources para padronização.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function handle_request(Request $request): JsonResponse
    {
            try {
            // Repassa os dados para a camada de serviço processar
            $process_result = CarrinhoService::process_carrinho($request->all());

            return response()->json([
                'status' => 'success',
                'data' => $process_result
            ], 200);
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}