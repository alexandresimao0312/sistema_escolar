
@extends('escola.admin.secretaria.exports.layoutPDF')
@section('conteudo')
  <h2>Ficha do Aluno</h2>
  <hr>

    <div class="info">
        <p><strong>Nome:</strong> {{ $aluno->nome }}</p>
        <p><strong>Email:</strong> {{ $aluno->email }}</p>
        <p><strong>Gênero:</strong> {{ $aluno->genero ?? 'INDISPONIVEL' }}</p>
        <p><strong>Data de Nascimento:</strong> {{ $aluno->data_nascimento ?? 'INDISPONIVEL' }}</p>
    </div>
    <hr>
    <h3>Matrículas</h3>
    <hr>
 
    <table>
        <thead>
            <tr>
                <th>Curso</th>
                <th>Classe</th>
                <th>Turma</th>
                <th>Ano Letivo</th>
                <th>Turno</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aluno->matriculas as $matricula)
                <tr>
                    <td>{{ $matricula->curso?->nome ?? 'INDISPONIVEL' }}</td>
                    <td>{{ $matricula->classe?->nome ?? 'INDISPONIVEL' }}</td>
                    <td>{{ $matricula->turma?->nome ?? 'INDISPONIVEL' }}</td>
                    <td>{{ $matricula->data_matricula }}</td>
                    <td>{{ $matricula->turno }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
@endsection
