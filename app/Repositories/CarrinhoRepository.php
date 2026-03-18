<?php

namespace App\Repositories;

use App\Models\Carrinho;
use Illuminate\Support\Facades\Cache;

class CarrinhoRepository
{

    /**
     * Busca registros paginados de Carrinho no banco de dados.
     * * IMPORTANTE:
     * - Priorize paginação para listagens extensas.
     * - Utilize cache para consultas repetitivas.
     * - Certifique-se de que a tabela possua indexação adequada.
     *
     * @param int $per_page Quantidade de itens por página.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function get_paginated_carrinhos(int $per_page = 15)
    {
        // Exemplo sugerido de cache com paginação:
        // return Cache::remember('carrinhos_page_' . request('page', 1), 3600, function () use ($per_page) {
        //     return Carrinho::paginate($per_page);
        // });

        return Carrinho::paginate($per_page);
    }
}