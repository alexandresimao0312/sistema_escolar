<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Comprovativo de Pagamento</title>
    <style>
         body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        .info { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>Comprovativo de Pagamento</h2>

    <div class="info">
        <p><strong>Aluno:</strong> {{ $aluno->nome }}</p>
        <p><strong>Mês:</strong> {{ $mensalidade->mes }}/{{ $mensalidade->ano }}</p>
        <p><strong>Valor:</strong> Kz {{ number_format($pagamento->valor_pago, 2, ',', '.') }}</p>
        <p><strong>Data de Pagamento:</strong> {{ date('d/m/Y', strtotime($pagamento->data_pagamento)) }}</p>
        <p><strong>Forma de Pagamento:</strong> {{ $pagamento->forma_pagamento }}</p>
        <p><strong>Referência:</strong> {{ $pagamento->referencia ?? 'N/A' }}</p>
    </div>

    <p>Obrigado pelo seu pagamento.</p>
</body>
</html>
