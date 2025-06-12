<script>
    $(document).ready(function () {
        // Select2 para Aluno
        $('#aluno_id').select2({
            placeholder: 'Digite o nome do aluno',
            minimumInputLength: 1,
            ajax: {
                url: '/alunos/buscar',
                dataType: 'json',
                delay: 250,
                data: params => ({ q: params.term }),
                processResults: data => ({
                    results: data.map(aluno => ({
                        id: aluno.id,
                        text: aluno.nome
                    }))
                })
            }
        });
    
        // Quando o aluno for selecionado, busca as mensalidades em aberto
        $('#aluno_id').on('change', function () {
            const alunoId = $(this).val();
    
            $.ajax({
                url: '/mensalidades/das-dividas/' + alunoId,
                type: 'GET',
                success: function (data) {
                    $('#mensalidade_ids').empty();
    
                    data.forEach(mensalidade => {
                        const option = new Option(
                            mensalidade.mes + ' de ' + mensalidade.ano + ' - Kz ' + mensalidade.valor,
                            mensalidade.id,
                            false,
                            false
                        );
                        $(option).attr('data-valor', mensalidade.valor);
                        $('#mensalidade_ids').append(option);
                    });
    
                    $('#mensalidade_ids').trigger('change');
                },
                error: function () {
                    alert('Erro ao buscar as mensalidades.');
                }
            });
        });
    
        // Select2 para Mensalidades
        $('#mensalidade_ids').select2({
            placeholder: 'Mensalidades pendentes',
            width: '100%'
        });
    
        // Soma automática do valor total ao selecionar mensalidades
        $('#mensalidade_ids').on('change', function () {
            let total = 0;
            $(this).find('option:selected').each(function () {
                total += parseFloat($(this).data('valor'));
            });
    
            $('#valor_pago').val(total.toFixed(2));
        });
    });
    </script>
    
  <script>
    $('#mensalidade_ids').on('change', function () {
        let selectedOptions = $(this).select2('data');
        let total = 0;
  
        selectedOptions.forEach(function (mensalidade) {
            let valor = parseFloat($(mensalidade.element).data('valor'));
            if (!isNaN(valor)) {
                total += valor;
            }
        });
  
        $('#valor_pago').val(total.toFixed(2));
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('myChart');
    if (ctx) {
        const myChart = new Chart(ctx, {
            type: 'bar', // ou outro tipo
            data: {
                labels: ['Jan', 'Fev', 'Mar'],
                datasets: [{
                    label: 'Exemplo',
                    data: [12, 19, 3],
                    backgroundColor: ['#007bff', '#28a745', '#ffc107']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }
});
  </script>

<script>
    $(document).ready(function () {
        $('#matricula_id').select2({
            placeholder: 'Digite o nome do aluno',
            ajax: {
                url: '{{ route('secretaria.matriculas.buscar') }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.results
                    };
                },
                cache: true
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#aluno_id').select2({
            placeholder: 'Digite o nome do aluno',
            ajax: {
                url: '{{ route('secretaria.alunos.buscar') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return { q: params.term };
                },
                processResults: function(data) {
                    return {
                        results: data.results
                    };
                },
                cache: true
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#receiver_type').on('change', function () {
        const tipo = $(this).val();

        $('#receiver_id').val(null).trigger('change'); // Limpa o select
        $('#receiver_id').select2({
            ajax: {
                url: '{{ route("chat.buscar.usuarios") }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        tipo: tipo,
                        q: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(user => ({
                            id: user.id,
                            text: user.nome
                        }))
                    };
                },
                cache: true
            },
            placeholder: 'Selecione o usuário...',
            minimumInputLength: 0
        });
    });

    // Inicializa o Select2
    $('#receiver_id').select2({
        placeholder: 'Selecione o usuário...'
    });


  