<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagamentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        
            return [
                
                'mensalidade_id' => 'required|array|min:1',
                'mensalidade_id.*' => 'exists:mensalidades,id',
                'forma_pagamento' => 'required|string|max:255',
            ];
     
    }
    public function messages()
    {
        return [

            'mensalidade_id.required'=> 'Mensalidade : O Campo Mensalidade É Obrigatorio!',
            'mensalidade_id.exists'=> 'Mensalidade : A Mensalidade Não Existe, Verifica Bem Os Dados',
            'mes.required'=> 'Mes : Mes  da Mensalidade É Obrigatorio!',
            'ano.required'=> 'Ano : O Ano Lectivo É Obrigatorio!',
            'forma_pagamento.required'=> 'Forma de Pagamento : a Forma de Pagamento É Obrigatorio!',
            'valor_pago.required'=> 'Valor : O Valor É Obrigatorio!',
            'valor_pago.numeric'=> 'Valor Pago: O Valor Do Pagamento Deve Ser Do Tipo Numerico!',
            'data_pagamento.required'=> 'Data de Pagamento : Data de Pagamento é obrigatorio!',
           
        ];
         }
}
