<?php

namespace App\Http\Services;

use stdClass;

class FreteService
{
    private $altura;
    private $largura;
    private $peso;
    private $constDiv = 10;
    
    public function __construct($altura, $largura, $peso)
    {
        $this->altura = $altura;
        $this->largura = $largura;
        $this->peso = $peso;
    }

    public function buscaEntrega()
    {
        //array responsavel pela validação das dimensões
        $validaDimensao = [];

        //simulando uma chamda de API que retorna os tipos de fretes
        $validaDimensao['altura'] = $this->verificaDimensaoAltura($this->altura);
        
        //verifica e retorna os tipos de frete que possuem a dimensão de largura adequada
        $validaDimensao['largura'] = $this->verificaDimensaoLargura($this->largura);

        //verifica quais tipos de frete estão dentro das dimensões de altura e largura
        $tipoEntrega = $this->verificaFrete($validaDimensao);

        //retorna o array com o objeto dos fretes disponiveis
        $fretes = $this->verificaTipoEntrega($tipoEntrega, $this->peso);

        return $fretes;
    }

        private function verificaDimensaoAltura($dimensao)
    {
        $tiposFrete = $this->getTipoFrete();
        $tipoEntrega = [];
        foreach ($tiposFrete as $tipoFrete) {
            if($dimensao >= $tipoFrete->alturaMin && $dimensao <= $tipoFrete->alturaMax) $tipoEntrega [] = $tipoFrete->nome;
        }

        return $tipoEntrega;
    }

    private function verificaDimensaoLargura($dimensao)
    {
        $tiposFrete = $this->getTipoFrete();
        $tipoEntrega = [];
        foreach ($tiposFrete as $tipoFrete) {
            if($dimensao >= $tipoFrete->larguraMin && $dimensao <= $tipoFrete->larguraMax) $tipoEntrega [] = $tipoFrete->nome;
        }

        return $tipoEntrega;
    }

    private function verificaFrete($dimensoes)
    {
        $tipoEntrega = [];
        $tiposFrete = $this->getTipoFrete();
        foreach ($tiposFrete as $tipoFrete) {
            if(in_array($tipoFrete->nome, $dimensoes['altura']) && in_array($tipoFrete->nome, $dimensoes['largura']))
            $tipoEntrega [] = $tipoFrete->nome;
        }

        return $tipoEntrega;
    }
    
    private function verificaTipoEntrega($tipoEntrega, $peso)
    {
        $entregas = [];
        $tiposFrete = $this->getTipoFrete();

        foreach ($tiposFrete as $tipoFrete) {
            if(in_array($tipoFrete->nome, $tipoEntrega)){
                $novaEntrega = new stdClass();
                $novaEntrega->nome = "Entrega ".$tipoFrete->nome;
                $novaEntrega->valor_frete = ($peso * $tipoFrete->constanteCalc)/$this->constDiv;
                $novaEntrega->prazo_dias = $tipoFrete->prazo;

                $entregas [] = $novaEntrega;
            }
        }

        return $entregas;
    }

    public function getTipoFrete()
    {
        $arrayTipoFrete  = [
            [
                "nome" => "Ninja", 
                "altura_minima" => 10, 
                "altura_maxima" => 200, 
                "largura_minima" => 6,  
                "largura_maxima" => 140, 
                "prazo" => 6,
                "constante_calculo" => 0.3
            ],
            [
                "nome" => "Kabum", 
                "altura_minima" => 5, 
                "altura_maxima" => 140, 
                "largura_minima" => 13,  
                "largura_maxima" => 125, 
                "prazo" => 4,
                "constante_calculo" => 0.2
            ],
        ];
        $novosTipoFrete = [];
        foreach ($arrayTipoFrete as $tipoFrete) {
            $novoTipoFrete = new stdClass();
            $novoTipoFrete->nome = $tipoFrete['nome'];
            $novoTipoFrete->alturaMin = $tipoFrete['altura_minima'];
            $novoTipoFrete->alturaMax = $tipoFrete['altura_maxima'];
            $novoTipoFrete->larguraMin = $tipoFrete['largura_minima'];
            $novoTipoFrete->larguraMax = $tipoFrete['largura_maxima'];
            $novoTipoFrete->prazo = $tipoFrete['prazo'];
            $novoTipoFrete->constanteCalc = $tipoFrete['constante_calculo'];  

            $novosTipoFrete [] =  $novoTipoFrete;
        }
        
        return $novosTipoFrete;
    }
}