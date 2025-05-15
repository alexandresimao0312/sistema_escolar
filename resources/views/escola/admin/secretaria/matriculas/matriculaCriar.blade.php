
@extends('escola.admin.layouts.layout')
@section('conteudo')
<!-- Alert de sucess-->
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if (session()->has('errors'))
<div class="alert alert-danger" role="alert">
  {{session('errors')}} 
</div>
@endif
<!-- Fim do Alert de sucess-->

<div class="container " id="abaCadastrarAlunos" role="tabpanel" aria-labelledby="Cadastrar Alunos">
    <label class="h3">Matricula alunos</label>
    <hr>
    <form action="{{route('secretaria.matriculas.store')}}" method="post"  id="formCadastroAluno">
        @csrf
      <input type='reset' class="btn btn-warning btn-sm" id="resetForm" value='Limpar todos os campos'/>
      <a class="btn btn-info btn-sm" onclick="carregaProfsETurmas()" id="atualizaMatricula"><span data-feather="refresh-cw"></span> Atualizar número de matrícula e turmas</a>
      <br><br>
      <input type="radio" name="tipoMatricula" id="tipoMatricula" checked onclick="document.getElementById('atualizaMatricula').style.visibility = 'visible', document.getElementById('atualizaMatricula').click(), document.getElementById('matriculaAluno').disabled = false, document.getElementById('geraDocsSection').style.visibility = 'visible'" value="matricula">
      <label for="tipoMatricula">Matrícula</label>
      <br>
      @include('escola.admin.includes.matriculaForm')
      <section class="fixed-bottom" style="position:fixed; width: 97%; align-content: center; bottom:40px; right:40px; margin-top:70px;">
        <button type="submit" class="btn btn-primary" style="float: right;" id="cadastrarAluno">Matricula Aluno</button>
        
      </section>
      
      <br><br>
    </form>
  </div>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
        $('#curso_id').on('change', function () {
            let cursoId = $(this).val();
    
            $('#classe_id').html('<option value="">Carregando classes...</option>');
            $('#turma_id').html('<option value="">Selecione a classe primeiro</option>');
    
            if (cursoId) {
                $.get('/classes/por-curso/' + cursoId, function (data) {
                    $('#classe_id').empty().append('<option value="">Selecione a Classe</option>');
                    data.forEach(classe => {
                        $('#classe_id').append(`<option value="${classe.id}">${classe.nome}</option>`);
                    });
                });
            }
        });
    
        $('#classe_id').on('change', function () {
            let cursoId = $('#curso_id').val();
            let classeId = $(this).val();
    
            $('#turma_id').html('<option value="">Carregando turmas...</option>');
    
            if (cursoId && classeId) {
                $.get(`/turmas/por-curso-e-classe/${cursoId}/${classeId}`, function (data) {
                    $('#turma_id').empty().append('<option value="">Selecione a Turma</option>');
                    data.forEach(turma => {
                        $('#turma_id').append(`<option value="${turma.id}">${turma.nome}</option>`);
                    });
                });
            }
        });
    });
    </script>
    <script>
      $(document).ready(function () {
          $('#aluno_id').on('change', function () {
              var alunoId = $(this).val();
  
              $('#mensalidade_id').html('<option value="">Carregando...</option>');
  
              if (alunoId) {
                  $.get('/mensalidades/por-aluno/' + alunoId, function (data) {
                      $('#mensalidade_id').html('<option value="">Selecione a Mensalidade</option>');
                      data.forEach(function (mensalidade) {
                          $('#mensalidade_id').append(
                              `<option value="${mensalidade.id}">
                                  ${mensalidade.mes_nome} - ${mensalidade.ano} (${mensalidade.valor} Kz)
                              </option>`
                          );
                      });
                  });
              }
          });
      });
  </script>
@endsection