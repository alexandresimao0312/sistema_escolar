<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório do Aluno</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            margin: 20px;
        }
        h2, h3 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .info {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h2>Ficha do Aluno</h2>

    <div class="info">
        <p><strong>Nome:</strong> {{ $aluno->nome }}</p>
        <p><strong>Email:</strong> {{ $aluno->email }}</p>
        <p><strong>Gênero:</strong> {{ $aluno->genero ?? 'INDISPONIVEL' }}</p>
        <p><strong>Data de Nascimento:</strong> {{ $aluno->data_nascimento ?? 'INDISPONIVEL' }}</p>
    </div>

    <h3>Matrículas</h3>
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
                    <td>{{ $matricula->estado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>