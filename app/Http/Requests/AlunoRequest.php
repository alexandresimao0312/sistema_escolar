<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlunoRequest extends FormRequest
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
            //
            'nome' => 'required|regex:/^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/|max:255|min:6',
            'nif' => 'required|string|unique:alunos,nif|min:6|max:16|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]+$/',
            'email'=> 'required|unique:alunos,email|email',
            'data_nascimento' => 'required|date',
            'telefone' => 'required',
            'endereco' => 'required',
            'genero' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'nome.required'=> 'Nome : O Campo Nome É Obrigatorio!',
            'nome.min'=> 'Nome : Digite Ao Menos 6 Caracteres!',
            'nome.max'=> 'Nome : Digite No Maximo 255 Caracteres!',
            'nome.regex'=> 'Nome : O Campo Nome Deve Conter Apenas Letras!',

            'nif.required'=> 'Nif : O Campo Nif É Obrigatorio!',
            'nif.min'=> 'Nif : Digite Ao Menos 6 Caracteres!',
            'nif.unique'=> 'Nif : Já Existe Um Aluno Com Esse Nif, O Nif Deve Ser Unico!',
            'nif.max'=> 'Nif : Digite No Maximo 16 Caracteres!',
            'nif.regex'=> 'Nif : O Campo Nif Deve Conter Letras e Numero!',


            'data_nascimento.required'=> 'Data de Nascimento : A data de Nascimento É Obrigatorio!',
            'genero.required'=> 'Gênero : O Gênero É Obrigatorio!',

            'telefone.required'=> 'Telefone : O Numero de Telefone É Obrigatorio!',
            'endereco.required'=> 'Endereço : O Endereço do Aluno É Obrigatorio!',

            'email.unique'=> 'Email : Já Existe Um Aluno Com Esse Email, O Email Deve Ser Unico!',
            'email.required'=> 'Email : Email é obrigatorio!',
            'email.email'=> 'Email : O Email teve terminar em gmail.com!',

           
        ];
         }
}
