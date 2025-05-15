<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista de Alunos</title>
    <style>
         body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
    </style>
</head>
<body>
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
</body>
</html>
