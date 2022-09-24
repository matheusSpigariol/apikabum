<?php

namespace App\Http\Controllers;

use App\Http\Requests\FreteRequest;
use App\Http\Services\FreteService;

class FreteController extends Controller
{
    public function listarFretes(FreteRequest $request)
    {
        $objFreteService = new FreteService($request->dimensao['altura'], $request->dimensao['largura'], $request->peso);
        $fretes = $objFreteService->buscaEntrega();
        return response($fretes);
    }
}
