
 @extends('escola.admin.secretaria.exports.layoutPDF')
@section('conteudo')
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
@endsection