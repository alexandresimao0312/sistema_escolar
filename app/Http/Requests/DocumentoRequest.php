<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentoRequest extends FormRequest
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
            'titulo' => 'required|string|max:255',
            'tipo' => 'required|in:declaração,histórico,boletim,outro',
            'arquivo' => 'required|file|mimes:pdf|max:2048',
            'aluno_id' => 'exists:alunos,id',
            'funcionario_id' => 'exists:funcionarios,id',
            'observacoes' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'Titulo : O Titulo é Obrigatorio',
            'titulo.max' => 'Titulo : O Titulo Deve Conter Apenas 255 Caracteres',
            'tipo.required' => 'Tipo : O Tipo é Obrigatorio',
            'tipo.in' => 'Tipo : O Tipo Aceita Apenas Valores Como; Declaração, Historico, Boletim e Outros ',
            'arquivo.required' => 'Arquivo : O Arquivo é Obrigatorio',
            'arquivo.file' => 'Arquivo : O Arquivo Deve Ser Do Tipo File (Documentos)',
            'arquivo.mimes' => 'Arquivo : O Arquivo Deve Ter A Extensão de PDF',
            'arquivo.max' => 'Arquivo : O Arquivo Deve Conter Um Tamanho de Apenas 2048 (Peso Do Arquivo)',
            'aluno_id.exists' => 'Aluno : Não Existe Esse Aluno No Nosso Banco De Dados',
            'funcionario_id.exists' => 'Funcionario : Não Existe Esse Funcionario No Nosso Banco De Dados',
            'observacoes.nullable' => 'Aluno : A Observações Não Deve Ser Nulo',

        ];
    }
}
