@extends('escola.admin.layouts.layout')
@section('conteudo')
<div class="container">
    <!-- Alert de sucess-->
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<!-- Fim do Alert de sucess-->

 <!-- Alert de erro-->
 @if ($errors->any())
 <div class="alert alert-danger">
  Não Foi Possivel Realizar Essa Operação :
  <ul class="mt-2 mb-0">
    @foreach ($errors->all() as $error)
    <li>{{ $error }} </li>  
    @endforeach
  </ul>
</div>  
 @endif
   <!-- Fim do Alert -->
    <h4>Atualizar Pagamento</h4>
    <form action="{{ route('secretaria.pagamentos.update', $pagamento->id) }}" method="POST">
        @csrf
        @method('put')
        @include('escola.admin.includes.pagamentoForm')
        <button type="submit" class="btn btn-success">Atualizar Pagamento</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const select = document.getElementById('mensalidade_id');
        const info = document.getElementById('infoMensalidade');
        const alunoNome = document.getElementById('alunoNome');
        const valorMensalidade = document.getElementById('valorMensalidade');
        const valorPago = document.getElementById('valorPago');
        const valorRestante = document.getElementById('valorRestante');
        const estado = document.getElementById('estadoMensalidade');
        const alertaPago = document.getElementById('alertaPago');

        select.addEventListener('change', function () {
            const option = select.options[select.selectedIndex];
            if (!option || option.value === "") {
                info.classList.add('d-none');
                return;
            }

            alunoNome.textContent = option.dataset.aluno;
            valorMensalidade.textContent = parseFloat(option.dataset.valor).toFixed(2);
            valorPago.textContent = parseFloat(option.dataset.pago).toFixed(2);
            valorRestante.textContent = parseFloat(option.dataset.restante).toFixed(2);
            estado.textContent = option.dataset.estado;

            info.classList.remove('d-none');
            if (option.dataset.estado === "pago") {
                alertaPago.classList.remove('d-none');
            } else {
                alertaPago.classList.add('d-none');
            }
        });
    });
</script>
@endsection
