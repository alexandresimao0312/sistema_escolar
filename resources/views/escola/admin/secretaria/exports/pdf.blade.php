<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Lista de Matrículas</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #999; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
   
</head>
<body>
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
</body>
</html>
