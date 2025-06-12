
@extends('escola.admin.secretaria.exports.layoutPDF')
@section('conteudo')
    <h2>Comprovativo de Pagamento</h2>
    <hr>

    <div class="info">
        <p><strong>Aluno:</strong> {{ $aluno->nome }}</p>
        <p><strong>Mês:</strong> {{ $mensalidade->mes }}/{{ $mensalidade->ano }}</p>
        <p><strong>Valor:</strong> Kz {{ number_format($pagamento->valor_pago, 2, ',', '.') }}</p>
        <p><strong>Data de Pagamento:</strong> {{ date('d/m/Y', strtotime($pagamento->data_pagamento)) }}</p>
        <p><strong>Forma de Pagamento:</strong> {{ $pagamento->forma_pagamento }}</p>
        <p><strong>Referência:</strong> {{ $pagamento->referencia ?? 'N/A' }}</p>
    </div>

    <p>Obrigado pelo seu pagamento.</p>
    <hr>
@endsection
