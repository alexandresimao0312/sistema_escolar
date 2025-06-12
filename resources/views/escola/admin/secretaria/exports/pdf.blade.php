
 @extends('escola.admin.secretaria.exports.layoutPDF')
@section('conteudo')
 <h2>Lista de Matrículas</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Aluno</th>
                <th>Curso</th>
                <th>Classe</th>
                <th>Turma</th>
                <th>Turno</th>
                <th>Data Matrícula</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($matriculas as $matricula)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $matricula->aluno->nome }}</td>
                    <td>{{ $matricula->curso->nome }}</td>
                    <td>{{ $matricula->classe->nome }}</td>
                    <td>{{ $matricula->turma->nome }}</td>
                    <td>{{ $matricula->turno }}</td>
                    <td>{{ \Carbon\Carbon::parse($matricula->data_matricula)->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Nenhuma matrícula encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection