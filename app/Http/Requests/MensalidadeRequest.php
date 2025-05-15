<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MensalidadeRequest extends FormRequest
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
            'matricula_id' => 'required|exists:matriculas,id',
            'mes' => 'required',
            'ano' => 'required|numeric',
            'valor' => 'required|numeric',
            'data_vencimento' => 'required|date',
        ];
    }
    public function messages()
    {
        return [

            'matricula_id.required'=> 'Matricula : O Campo Matricula É Obrigatorio!',
            'matricula_id.exists'=> 'Matricula : Já Existe Um Aluno Com Esse Numero De Matricula, Verifica Bem Os Dados',
            'mes.required'=> 'Mes : Mes  da Mensalidade É Obrigatorio!',
            'ano.required'=> 'Ano : O Ano Lectivo É Obrigatorio!',
            'ano.numeric'=> 'Ano : O Ano Lectivo Deve Ser Do Tipo Numerico!',
            'valor.required'=> 'Valor : O Valor É Obrigatorio!',
            'valor.numeric'=> 'Valor : O Valor Da Mensalidade A Cobrar Deve Ser Do Tipo Numerico!',
            'data_vencimento.required'=> 'Data de Vencimento : Data de Vencimento é obrigatorio!',
           
        ];
         }
}
