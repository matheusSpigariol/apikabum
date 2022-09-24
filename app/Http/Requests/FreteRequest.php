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
            'dimensao.altura' => 'required|numeric|min:5|max:200',
            'dimensao.largura' => 'required|numeric|min:6|max:140',
            'peso' => 'required|numeric|gt:0'
        ];
    }

    public function messages()
    {
        return[
            'required' => 'O campo :attribute é obrigatório',
            'numeric' => 'O campo :attribute deve ser um número',
            'gt' => 'O campo :attribute deve ser maior que 0 gramas',
            'min' => 'O campo :attribute deve ter no mínimo :min centímetros',
            'max' => 'O campo :attribute deve ter no máximo :max centímetros'
        ];
    }
}
