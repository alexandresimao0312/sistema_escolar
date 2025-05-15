<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h3, h4 { margin: 0; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid #000; padding: 5px; text-align: left; }
    </style>
</head>
<body>
    <h3>Histórico do Aluno</h3>
    <p><strong>Nome:</strong> {{ $aluno->nome }}</p>
    <p><strong>Email:</strong> {{ $aluno->email ?? '---' }}</p>

    @foreach ($aluno->matriculas as $matricula)
        <h4>Matrícula: {{ $matricula->curso->nome }} ({{ ucfirst($matricula->curso->tipo) }})</h4>
        <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($matricula->data_matricula)->format('d/m/Y') }}</p>

        <table class="table">
            <thead>
                <tr>
                    <th>Mês</th>
                    <th>Valor</th>
                    <th>Estado</th>
                    <th>Pagamentos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matricula->mensalidades as $mensalidade)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($mensalidade->mes_referencia)->format('m/Y') }}</td>
                        <td>{{ number_format($mensalidade->valor, 2, ',', '.') }}</td>
                        <td>{{ ucfirst($mensalidade->estado) }}</td>
                        <td>
                            @foreach ($mensalidade->pagamentos as $pagamento)
                                {{ \Carbon\Carbon::parse($pagamento->data_pagamento)->format('d/m/Y') }} -
                                {{ number_format($pagamento->valor_pago, 2, ',', '.') }} Kz<br>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>
