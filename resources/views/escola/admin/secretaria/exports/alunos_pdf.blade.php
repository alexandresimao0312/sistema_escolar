@extends('escola.admin.secretaria.exports.layoutPDF')
@section('conteudo')
    <h2>Lista de Alunos</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Data de Criação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alunos as $index => $aluno)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $aluno->nome }}</td>
                    <td>{{ $aluno->email }}</td>
                    <td>{{ $aluno->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    
@endsection
