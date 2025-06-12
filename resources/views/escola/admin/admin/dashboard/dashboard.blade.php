@extends('escola.admin.admin.layouts.layout')

@section('conteudo')
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Valor</th>
                <th>Mês</th>
                <th>Data do Pagamento</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ultimosPagamentos as $pagamento)
            <tr>
                <td>{{ $pagamento->mensalidade->matricula->aluno->nome ?? 'Aluno removido' }}</td>
                <td>{{ number_format($pagamento->valor_pago, 2, ',', '.') }}</td>
                <td>{{ $pagamento->mensalidade->mes}}</td>
                <td>{{ \Carbon\Carbon::parse($pagamento->data_pagamento)->format('d/m/Y') }}</td>
            </tr> 
            @empty
            <tr><td colspan="8" class="text-center">Nenhum pagamento encontrado.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>


<h2 class="h2">Gráficos</h2>

<div class="row">
    <div class="col-md-6">
        <canvas id="graficoMensalidades"></canvas>
    </div>

    <div class="col-md-6">
        <canvas id="graficoAlunosMatriculas"></canvas>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Gráfico de Mensalidades
    const ctxMensalidades = document.getElementById('graficoMensalidades').getContext('2d');
    new Chart(ctxMensalidades, {
        type: 'doughnut',
        data: {
            labels: ['Pagas', 'Pendentes'],
            datasets: [{
                data: [{{ $mensalidadesPagas }}, {{ $mensalidadesPendentes }}],
                backgroundColor: ['#28a745', '#ffc107'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Mensalidades'
                }
            }
        }
    });

    // Gráfico de Alunos e Matrículas
    const ctxAlunosMatriculas = document.getElementById('graficoAlunosMatriculas').getContext('2d');
    new Chart(ctxAlunosMatriculas, {
        type: 'bar',
        data: {
            labels: ['Alunos', 'Matrículas'],
            datasets: [{
                label: 'Total',
                data: [{{ $totalAlunos }}, {{ $totalMatriculas }}],
                backgroundColor: ['#007bff', '#17a2b8'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Alunos e Matrículas'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>

@endsection
