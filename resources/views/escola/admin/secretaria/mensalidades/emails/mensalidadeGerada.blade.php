<p>Olá {{ $aluno->nome }},</p>
<p>Foi gerada uma nova mensalidade referente ao mês {{ $mensalidade->mes }}/{{ $mensalidade->ano }} no valor de {{ number_format($mensalidade->valor, 2, ',', '.') }} KZ.</p>
<p>Data de vencimento: {{ \Carbon\Carbon::parse($mensalidade->data_vencimento)->format('d/m/Y') }}</p>
<p>Por favor, efetue o pagamento até a data.</p>
