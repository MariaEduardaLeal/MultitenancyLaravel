<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;

class CarrinhoService
{
    /**
     * Processa a regra de negócio principal.
     * * IMPORTANTE: 
     * - Utilize transactions em operações críticas de escrita.
     * - Envie processos demorados para queues via Jobs.
     *
     * @param array $carrinho_data Dados validados vindos do Form Request.
     * @return void
     * @throws Exception
     */
    public static function process_carrinho(array $carrinho_data): void
    {
        DB::beginTransaction();

        try {
            // Insira a regra de negócio isolada aqui
            
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}