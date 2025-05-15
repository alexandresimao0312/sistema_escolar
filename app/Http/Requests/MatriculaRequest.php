<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatriculaRequest extends FormRequest
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
            'aluno_id' => 'required|exists:alunos,id',
            'curso_id' => 'required|exists:cursos,id',
            'classe_id' => 'required|exists:classes,id',
            'turma_id' => 'required|exists:turmas,id',
            'data_matricula' => 'required|string',
            'turno' => 'required|string',
          
        ];
    }
    public function messages()
    {
        return [
           
            'aluno_id.required'=> 'Aluno : O Campo Aluno É Obrigatorio!',
            'aluno.exists'=> 'Aluno : O Aluno Deve Existir, Verifica Bem Os Dados E Tenta Novamente!',
            
            'curso_id.required'=> 'Curso: O Campo Curso É Obrigatorio!',
            'curso_id.exists'=> 'Curso : O Curso Deve Existir, Verifica Bem Os Dados E Tenta Novamente!',

            'classe_id.required'=> 'Classe : O Campo Classe É Obrigatorio!',
            'classe_id.exists'=> 'Classe : A classe Deve Existir, Verifica Bem Os Dados E Tenta Novamente!',
            
            'turma_id.required'=> 'Turma : O Campo Turma É Obrigatorio!',
            'turma_id.exists'=> 'Turma : A Turma Deve Existir, Verifica Bem Os Dados E Tenta Novamente!',


            'data_matricula.required'=> 'Data da Matrícula : A data da Matrícula É Obrigatorio!',
            'turno.required'=> 'Turno : O Turno É Obrigatorio!',

            'estado.required'=> 'Estado : O Estado É Obrigatorio!',


           
        ];
         }
}
