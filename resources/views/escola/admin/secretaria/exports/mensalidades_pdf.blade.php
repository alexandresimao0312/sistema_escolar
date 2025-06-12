
 @extends('escola.admin.secretaria.exports.layoutPDF')
@section('conteudo')
   <h2>Relatório de Mensalidades</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Aluno</th>
                <th>Curso</th>
                <th>Referência</th>
                <th>Valor</th>
                <th>Estado</th>
                <th>Data de Criação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mensalidades as $index => $mensalidade)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $mensalidade->matricula->aluno->nome }}</td>
                    <td>{{ $mensalidade->matricula->curso->nome }}</td>
                    <td>{{ $mensalidade->mes }}</td>
                    <td>{{ number_format($mensalidade->valor, 2, ',', '.') }}</td>
                    <td>{{ ucfirst($mensalidade->estado) }}</td>
                    <td>{{ $mensalidade->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
