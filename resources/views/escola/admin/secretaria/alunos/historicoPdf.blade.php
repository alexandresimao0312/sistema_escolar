
@extends('escola.admin.secretaria.exports.layoutPDF')
@section('conteudo')
 <h3>Histórico do Aluno</h3>
 <hr>
    <p><strong>Nome:</strong> {{ $aluno->nome }}</p>
    <p><strong>Email:</strong> {{ $aluno->email ?? '---' }}</p>

    @foreach ($aluno->matriculas as $matricula)
        <h4>Matrícula: {{ $matricula->curso->nome }} ({{ ucfirst($matricula->curso->tipo) }})</h4>
        <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($matricula->data_matricula)->format('d/m/Y') }}</p>
    <hr>
        <table class="table">
            <hr>
            <thead>
              
                    <th>Mês</th>
                    <th>Valor</th>
                    <th>Estado</th>
                    <th>Pagamentos</th>
                
            </thead>
            <hr>
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
    <hr>
@endsection