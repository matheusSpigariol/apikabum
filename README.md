# API Kabum Frete

## Sobre o projeto
> Este projeto consiste em uma aplicação criada em PHP, com o framework [Laravel](https://laravel.com/), para o calculo e seleção do tipo de frete, baseado no peso e dimensões do pacote.

## Pacotes utilizados
### Requisitos do projeto

Pacote   | Versão
--------- | ------
[PHP](https://laravel.com/docs/9.x) | ^8.1.2
[Laravel](https://laravel.com/docs/9.x) | ^9.31.0
[Composer](https://getcomposer.org/download/) | ^2.2.7

## Executando o projeto
### Comandos

>Para instalar as dependências do projeto:
~~~
composer install
~~~

>Para rodar o projeto localmente:
~~~php
php artisan serve
// por padrão irá ser criada na porta 8000
~~~

## Documentação

### Host
> Por ser uma aplicação local, será utilizado o localhost para as requisições.
~~~
http://127.0.0.1:8000
~~~

### Respostas

| Código HTTP | Descrição |
|---|---|
| `200` | Requisição executada com sucesso.|
| `422` | Dados informados estão fora do escopo definido para o campo.|

### Requisição

> POST
~~~
host/api/frete
~~~

### Header (cabeçalho)

| Parâmetro |  |
|---|---|
| Content-Type| application/json|
| Accept | application/json|

### Body (corpo)

    {
        "dimensao": {
            "altura": {altura_pacote},
            "largura": {largura_pacote}
        },
        "peso": {peso_pacote},
    }

### Responses (respostas)
#### 200

    [
        {
            "nome": "{tipo_entrega}",
            "valor_frete": {valor_frete},
            "prazo_dias": {prazo_dias}
        },
        {
            "nome": "{tipo_entrega}",
            "valor_frete": {valor_frete},
            "prazo_dias": {prazo_dias}
        },
    ]

#### 422
    {
        "errors": {
            "dimensao": [
                "O campo dimensao é obrigatório",
            ],
            "dimensao.altura": [
                "O campo dimensao.altura é obrigatório",
                "O campo dimensao.altura deve ser um número",
                "O campo dimensao.altura deve ter no mínimo 5 centímetros",
                "O campo dimensao.altura deve ter no máximo 200 centímetros"
            ],
            "dimensao.largura": [
                "O campo dimensao.largura é obrigatório",
                "O campo dimensao.largura deve ser um número",
                "O campo dimensao.largura deve ter no mínimo 6 centímetros",
                "O campo dimensao.largura deve ter no máximo 140 centímetros"
            ],
            "peso": [
                "O campo dimensao.largura é obrigatório",
                "O campo dimensao.largura deve ser um número",
                "O campo peso deve ser maior que 0 gramas"
            ]
	    }
    }

### Exemplo Requisição

#### Endpoint
~~~
http://127.0.0.1:8000/api/frete
~~~

#### Corpo
    {
        "dimensao": {
            "altura": 120,
            "largura": 120
        },
        "peso": 50
    }

#### Resposta
    [
        {
            "nome": "Entrega Ninja"
            "valor_frete": 1.5
            "prazo_dias": 6
        },
        {
            "nome": "Entrega Kabum"
            "valor_frete": 1
            "prazo_dias": 4
        },
    ]
