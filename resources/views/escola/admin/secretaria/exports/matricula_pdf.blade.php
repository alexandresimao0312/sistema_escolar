 @extends('escola.admin.secretaria.exports.layoutPDF')
@section('conteudo')
   <h2>Relatório de Matrículas</h2>
    <table>
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Curso</th>
                <th>Ano</th>
                <th>Data da Matrícula</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matriculas as $matricula)
                <tr>
                    <td>{{ $matricula->aluno->nome }}</td>
                    <td>{{ $matricula->curso->nome }}</td>
                    <td>{{ $matricula->data_matricula }}</td>
                    <td>{{ $matricula->created_at->format('d/m/Y') }}</td>
                    <td>{{ ucfirst($matricula->estado) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table> 
@endsection