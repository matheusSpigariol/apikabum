<?php

namespace App\Http\Controllers;

use App\Http\Requests\FreteRequest;
use stdClass;

class FreteController extends Controller
{
    public function listarFretes(FreteRequest $request)
    {
        $fretes = $this->calculaFrete($request);
        return response($fretes);
    }

    private function calculaFrete($dados)
    {
        $constDiv = 10;

        $constNinja = 0.3;
        $prazoNinja = 6;

        $constkabum = 0.2;
        $prazoKabum = 4;

        $fretes = [];

        //validação entrega ninja
        if(($dados->dimensao['altura'] >= 10 && $dados->dimensao['altura'] <= 200) && 
        ($dados->dimensao['largura'] >= 6 && $dados->dimensao['largura'] <= 140)){
            $entregaNinja = new stdClass();
            $entregaNinja->nome = "Entrega Ninja";
            $entregaNinja->valor_frete = ($dados->peso * $constNinja)/$constDiv;
            $entregaNinja->prazo_dias = $prazoNinja;
            array_push($fretes, $entregaNinja);
        }

        //validação entrega kabum
        if(($dados->dimensao['altura'] >= 5 && $dados->dimensao['altura'] <= 140) && 
        ($dados->dimensao['largura'] >= 13 && $dados->dimensao['largura'] <= 125)){
            $entregaKabum = new stdClass();
            $entregaKabum->nome = "Entrega Kabum";
            $entregaKabum->valor_frete = ($dados->peso * $constkabum)/$constDiv;
            $entregaKabum->prazo_dias = $prazoKabum;
            array_push($fretes, $entregaKabum);
        }

        return $fretes;
    }
}
