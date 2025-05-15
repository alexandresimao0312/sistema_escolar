<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Comprovativo</title>
    <style>
        body { font-family: sans-serif; }
        .header { margin-bottom: 20px; }
        .info { margin-top: 20px; }
    </style>
</head>
<body>
    <h2>Comprovativo de Pagamento</h2>
    <div class="info">
        <p><strong>Aluno:</strong> {{ $mensalidade->matricula->aluno->nome }}</p>
        <p><strong>Mês/Ano:</strong> {{ $mensalidade->mes }}/{{ $mensalidade->ano }}</p>
        <p><strong>Valor:</strong> {{ number_format($mensalidade->valor, 2, ',', '.') }} KZ</p>
        <p><strong>Estado:</strong> {{ ucfirst($mensalidade->estado) }}</p>
    </div>
</body>
</html>
