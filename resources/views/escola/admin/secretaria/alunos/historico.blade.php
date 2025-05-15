@extends('escola.admin.layouts.layout')

@section('conteudo')
<div class="container mt-4">
    <h3>📚 Histórico do Aluno</h3>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('secretaria.secretaria.alunos.historico.pdf', $aluno->id) }}" class="btn btn-danger">
            <i class="bi bi-file-earmark-pdf"></i> Exportar em PDF
        </a>
    </div>    
    <div class="card mt-3">
        <div class="card-header bg-primary text-white">Informações do Aluno</div>
        <div class="card-body">
            <p><strong>Nome:</strong> {{ $aluno->nome }}</p>
            <p><strong>Email:</strong> {{ $aluno->email ?? 'Não informado' }}</p>
            <p><strong>Telefone:</strong> {{ $aluno->telefone ?? 'Não informado' }}</p>
        </div>
    </div>

    @foreach ($matriculas as $matricula)
        <div class="card mt-4">
            <div class="card-header bg-secondary text-white">
                Matrícula nº {{ $matricula->id }} - {{ $matricula->curso->nome }} ({{ ucfirst($matricula->curso->tipo) }})
            </div>
            <div class="card-body">
                <p><strong>Data da Matrícula:</strong> {{ \Carbon\Carbon::parse($matricula->data_matricula)->format('d/m/Y') }}</p>

                <h6>💳 Mensalidades:</h6>
                @if ($matricula->mensalidades->isEmpty())
                    <p class="text-muted">Nenhuma mensalidade gerada.</p>
                @else
                    <table class="table table-sm table-bordered">
                        <thead class="table-light">
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
                                    <td>{{ \Carbon\Carbon::parse($mensalidade->mes_referencia)->translatedFormat('F/Y') }}</td>
                                    <td>{{ number_format($mensalidade->valor, 2, ',', '.') }} Kz</td>
                                    <td>
                                        @if ($mensalidade->estado === 'pago')
                                            <span class="badge bg-success">Pago</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pendente</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($mensalidade->pagamentos->isEmpty())
                                            <span class="text-muted">Sem pagamento</span>
                                        @else
                                            <ul class="list-unstyled mb-0">
                                                @foreach ($mensalidade->pagamentos as $pagamento)
                                                    <li>
                                                        {{ \Carbon\Carbon::parse($pagamento->data_pagamento)->format('d/m/Y') }} -
                                                        {{ number_format($pagamento->valor_pago, 2, ',', '.') }} Kz
                                                        ({{ ucfirst($pagamento->forma_pagamento) }})
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
