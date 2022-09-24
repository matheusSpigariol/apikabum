<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FreteRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'dimensao' => 'required',
            'dimensao.altura' => 'required|numeric',
            'dimensao.largura' => 'required|numeric',
            'peso' => 'required|numeric|gt:0'
        ];
    }

    public function messages()
    {
        return[
            'required' => 'O campo :attribute é obrigatório',
            'numeric' => 'O campo :attribute deve ser um número',
            'gt' => 'O campo :attribute deve ser maior que 0',
        ];
    }
}
