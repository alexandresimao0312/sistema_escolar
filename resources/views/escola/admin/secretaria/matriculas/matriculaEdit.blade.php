
@extends('escola.admin.layouts.layout')
@section('conteudo')

<!-- Alert de sucess-->
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<!-- Fim do Alert de sucess-->

<div class="container " id="abaCadastrarAlunos" role="tabpanel" aria-labelledby="Cadastrar Alunos">
    <label class="h3">Atualizar Matricula</label>
    <hr>
    <form action="{{route('secretaria.matriculas.update', $matricula->id)}}" method="post"  id="formCadastroAluno">
        @csrf
        @method('PUT')
      <input type='reset' class="btn btn-warning btn-sm" id="resetForm" value='Limpar todos os campos'/>
      <a class="btn btn-info btn-sm" onclick="carregaProfsETurmas()" id="atualizaMatricula"><span data-feather="refresh-cw"></span> Atualizar número de matrícula e turmas</a>
      <br><br>
      <input type="radio" name="tipoMatricula" id="tipoMatricula" checked onclick="document.getElementById('atualizaMatricula').style.visibility = 'visible', document.getElementById('atualizaMatricula').click(), document.getElementById('matriculaAluno').disabled = false, document.getElementById('geraDocsSection').style.visibility = 'visible'" value="matricula">
      <label for="tipoMatricula">Matrícula</label>
      <br>
      @include('escola.admin.includes.matriculaForm')
      <section class="fixed-bottom" style="position:fixed; width: 97%; align-content: center; bottom:40px; right:40px; margin-top:70px;">
        <button type="submit" class="btn btn-primary" style="float: right;" id="cadastrarAluno">Atualizar Matricula</button>
        
      </section>
      
      <br><br>
    </form>
  </div>
    
@endsection