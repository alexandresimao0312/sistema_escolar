@extends('escola.admin.admin.layouts.layout')

@section('conteudo')
<div class="container">
    <h3>Resumo Financeiro</h3>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Saldo Atual</h5>
                    <p>{{ number_format($saldoCaixa, 2, ',', '.') }} KZ</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Receitas (Total)</h5>
                    <p>{{ number_format($totalReceitas, 2, ',', '.') }} KZ</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>Despesas (Total)</h5>
                    <p>{{ number_format($totalDespesas, 2, ',', '.') }} KZ</p>
                </div>
            </div>
        </div>
    </div>

    <canvas id="graficoFinanceiro"></canvas>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('graficoFinanceiro');
    const grafico = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($graficoMensal['meses']) !!},
            datasets: [
                {
                    label: 'Receitas',
                    backgroundColor: 'green',
                    data: {!! json_encode($graficoMensal['receitas']) !!}
                },
                {
                    label: 'Despesas',
                    backgroundColor: 'red',
                    data: {!! json_encode($graficoMensal['despesas']) !!}
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
