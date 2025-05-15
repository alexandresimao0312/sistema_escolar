<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Matrículas</title>
    <style>
        body { font-family: DejaVu Sans; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
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
</body>
</html>
