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
    <h4>Registrar Pagamento</h4>
    <form action="{{ route('secretaria.pagamentos.store') }}" method="POST">
        @csrf
        @include('escola.admin.includes.pagamentoForm')
        <button type="submit" class="btn btn-success">Registrar Pagamento</button>
    </form>
</div>       

@endsection
