@extends('escola.admin.admin.layouts.layout')
@section('conteudo')

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
<div class="container " id="abaCadastrarAlunos" role="tabpanel" aria-labelledby="Cadastrar Alunos">
    <label class="h3">Atualizar Cursos</label>
    <hr>
    <form action="{{route('admin.cursos.update', $curso->id)}}" method="post"  id="formCadastroAluno">
        @csrf
        @method('PUT')
        @include('escola.admin.includes.cursoForm')
      <section class="fixed-bottom" style="position:fixed; width: 97%; align-content: center; bottom:40px; right:40px; margin-top:70px;">
        <button type="submit" class="btn btn-primary" style="float: right;" id="cadastrarAluno">Atualizar Curso</button>
        
      </section>
      
      <br><br>
    </form>
  </div>
    
@endsection