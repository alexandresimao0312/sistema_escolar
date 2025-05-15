@extends('escola.admin.layouts.layout')
@section('conteudo')

<!-- Alert de sucess-->
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<!-- Fim do Alert de sucess-->

   <!-- Fim do Alert -->
<div class="container " id="abaCadastrarAlunos" role="tabpanel" aria-labelledby="Cadastrar Alunos">
    <label class="h3">Cadastro de alunos</label>
    <hr>
    <form action="{{route('secretaria.alunos.store')}}" method="post"  id="formCadastroAluno">
        @csrf
      <input type='reset' class="btn btn-warning btn-sm" id="resetForm" value='Limpar todos os campos'/>
      <a class="btn btn-info btn-sm" onclick="carregaProfsETurmas()" id="atualizaMatricula"><span data-feather="refresh-cw"></span> Atualizar número de matrícula e turmas</a>
      <br><br>
      <input type="radio" name="tipoMatricula" id="tipoMatricula" checked onclick="document.getElementById('atualizaMatricula').style.visibility = 'visible', document.getElementById('atualizaMatricula').click(), document.getElementById('matriculaAluno').disabled = false, document.getElementById('geraDocsSection').style.visibility = 'visible'" value="matricula">
      <label for="tipoMatricula">Matrícula</label>
      <br>
      <label class="h6">Dados pessoais</label>
        @include('escola.admin.includes.alunoForm')
      <section class="fixed-bottom" style="position:fixed; width: 97%; align-content: center; bottom:40px; right:40px; margin-top:70px;">
        <button type="submit" class="btn btn-primary" style="float: right;" id="cadastrarAluno">Cadastrar Aluno</button>
        
      </section>
      
      <br><br>
    </form>
  </div>
    
@endsection