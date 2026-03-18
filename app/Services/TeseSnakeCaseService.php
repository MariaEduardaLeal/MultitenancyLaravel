<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;

class TeseSnakeCaseService
{
    /**
     * Processa a regra de negócio principal.
     * * IMPORTANTE: 
     * - Utilize transactions em operações críticas de escrita.
     * - Envie processos demorados para queues via Jobs.
     *
     * @param array $tese_snake_case_data Dados validados vindos do Form Request.
     * @return void
     * @throws Exception
     */
    public static function process_tese_snake_case(array $tese_snake_case_data): void
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