<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pagamentos</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
    </style>
</head>
<body>
    <h2>Relatório de Pagamentos</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Aluno</th>
                <th>Referências Pagas</th>
                <th>Total Pago</th>
                <th>Forma de Pagamento</th>
                <th>Data de Pagamento</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pagamentos as $index => $pagamento)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        {{ $pagamento->mensalidade->first()->matricula->aluno->nome ?? '---' }}
                    </td>
                    <td>
                        @foreach ($pagamento->mensalidade as $p)
                        {{ $p->mes ?? '---' }}<br>
                        @endforeach
                    </td>
                    <td>{{ number_format($pagamento->valor_pago, 2, ',', '.') }}</td>
                    <td>{{ ucfirst($pagamento->forma_pagamento) }}</td>
                    <td>{{ $pagamento->data_pagamento ? \Carbon\Carbon::parse($pagamento->data_pagamento)->format('d/m/Y') : '---' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
