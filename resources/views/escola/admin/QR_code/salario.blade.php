@extends('escola.admin.admin.layouts.layout')

@section('title', 'Verificação de Recibo')

@section('conteudo')
<div class="container">
    <h2>Verificação de Recibo</h2>

    <div class="card mt-4">
        <div class="card-body">
            <p><strong>Código de Verificação:</strong> {{ $codigo }}</p>
            <p><strong>Funcionário:</strong> {{ $salario->funcionario->nome }}</p>
            <p><strong>Cargo:</strong> {{ $salario->funcionario->cargo }}</p>
            <p><strong>Mês de Referência:</strong> {{ \Carbon\Carbon::createFromFormat('m', $salario->mes)->locale('pt')->isoFormat('MMMM') }}/{{ $salario->ano }}</p>
            <p><strong>Valor Bruto:</strong> {{ number_format($salario->valor_bruto, 2, ',', '.') }} KZ</p>
            <p><strong>Descontos:</strong> {{ number_format($salario->descontos, 2, ',', '.') }} KZ</p>
            <p><strong>Valor Líquido:</strong> <strong>{{ number_format($salario->valor_liquido, 2, ',', '.') }} KZ</strong></p>
            <p><strong>Data de Pagamento:</strong> {{ $salario->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('admin.salarios.index') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>
@endsection
