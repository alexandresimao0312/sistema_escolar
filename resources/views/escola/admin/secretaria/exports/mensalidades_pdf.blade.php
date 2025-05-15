<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mensalidades</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
    </style>
</head>
<body>
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
</body>
</html>
