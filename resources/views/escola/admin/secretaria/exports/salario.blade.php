@extends('escola.admin.secretaria.exports.layoutPDF')
@section('conteudo')
    <!-- Dados do funcionário -->
        <div class="info-section">
            <h4>Dados do Funcionário</h4>
            <div class="row"><span class="label">Nome:</span> {{ $salario->funcionario->nome }}</div>
            <div class="row"><span class="label">Cargo:</span> {{ $salario->funcionario->cargo }}</div>
            <div class="row"><span class="label">Email:</span> {{ $salario->funcionario->email }}</div>
            <div class="row"><span class="label">Data:</span> {{ $salario->created_at->format('d/m/Y') }}</div>
        </div>

        <!-- Dados do salário -->
        <div class="info-section">
            <h4>Detalhes do Salário</h4>
            <div class="row"><span class="label">Salário Base:</span> {{ number_format($salario->salario_base, 2, ',', '.') }} Kz</div>
            <div class="row"><span class="label">Bonus ou Horas Exta:</span>  {{ number_format($salario->bonificacoes, 2, ',', '.') }} Kz</div>
            <div class="row"><span class="label">Descontos:</span> {{ number_format($salario->descontos, 2, ',', '.') }} Kz</div>
            <div class="total">Total Líquido: {{ number_format($salario->total_recebido, 2, ',', '.') }} Kz</div>
        </div>

        <div class="row" style="margin-top: 30px; justify-content: space-between; align-items: flex-end;">
    <div>
        {{-- QR Code com código único para validação --}}
        @php
            $codigoVerificacao = 'RECIBO-' . base64_encode($salario->id . '-' . $salario->created_at->format('Ym'));
        @endphp

        <div>
            <p style="margin-bottom: 2px; font-size: 11px;">Código de Verificação:</p>
            <p style="font-size: 12px; font-weight: bold;">{{ $codigoVerificacao }}</p>
            {!! QrCode::size(80)->generate($codigoVerificacao) !!}
        </div>
    </div>
</div>

@endsection
