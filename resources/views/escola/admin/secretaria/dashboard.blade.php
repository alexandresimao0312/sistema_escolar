@extends('escola.admin.layouts.layout')
@section('conteudo')
    
<canvas id="graficoEscala" width="800" height="200"></canvas>
@endsection
@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctxEscala = document.getElementById('graficoEscala').getContext('2d');

    const graficoEscala = new Chart(ctxEscala, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Total de Alunos por Nível',
                data: @json($valores),
                backgroundColor: ['#4CAF50', '#2196F3', '#FFC107'],
                borderColor: '#333',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Distribuição de Alunos por Nível'
                }
            }
        }
    });
</script>

@endsection
