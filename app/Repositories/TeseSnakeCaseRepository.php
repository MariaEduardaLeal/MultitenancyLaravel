<?php

namespace App\Repositories;

use App\Models\TeseSnakeCase;
use Illuminate\Support\Facades\Cache;

class TeseSnakeCaseRepository
{

    /**
     * Busca registros paginados de TeseSnakeCase no banco de dados.
     * * IMPORTANTE:
     * - Priorize paginação para listagens extensas.
     * - Utilize cache para consultas repetitivas.
     * - Certifique-se de que a tabela possua indexação adequada.
     *
     * @param int $per_page Quantidade de itens por página.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function get_paginated_tese_snake_cases(int $per_page = 15)
    {
        // Exemplo sugerido de cache com paginação:
        // return Cache::remember('tese_snake_cases_page_' . request('page', 1), 3600, function () use ($per_page) {
        //     return TeseSnakeCase::paginate($per_page);
        // });

        return TeseSnakeCase::paginate($per_page);
    }
}