@extends('escola.admin.admin.layouts.layout')
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
    <h4>Registrar Curso</h4>
    <form action="{{ route('admin.cursos.store') }}" method="POST">
        @csrf
        @include('escola.admin.includes.cursoForm')
        <button type="submit" class="btn btn-success">Registrar Curso</button>
    </form>
</div>       

@endsection
