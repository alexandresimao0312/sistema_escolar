@extends('escola.admin.layouts.layout')
@section('conteudo')
<div>
  <label class="text-secondary mb-1"> Resultado Da Busca Por " {{$keyword}} " No Campo {{$tipoDeBusca}}
  </label>
   <br>
  <div class="container">
    <form action="{{route('alunos.search')}}" method="get">
      @csrf
     <div class="row">
        <div class="form-group col-auto">
          <label for="inputAddress">Campo de busca</label>
          <input class="form-control" name="keyword" id="keyword"  type="search" placeholder="Digite a busca..." aria-label="Search">
        </div>
        <div class="form-group col-auto">
          <label for="inputAddress">Buscar por:</label>
          <select class="form-control" name="tipoDeBusca" id="tipoDeBusca" onchange="alteraTipoDeBusca(this.value)">
            <option selected value="nome">Nome do aluno</option>
            <option value="id">Codigo do Aluno</option>
            <option value="nif">NIF do aluno</option>
          </select>
          
        </div>
     </div> 
    </form>
   </div>
</div>
@if($aluno->isEmpty())
<div class="alert alert-danger">
  <p class="text-secondary mb-1">Nenhum Aluno Encontrado Na Busca Por {{$keyword}} No Campo {{$tipoDeBusca}}.</p>
</div>
@else
@foreach ($aluno as $aluno)
<div class="container" id="infoDoAluno" style="">
    <div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
             <div class="card">
              <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                  <img src="../images/profile_placeholder.png" alt="Imagem do aluno" class="" width="150" id="mostraFotoAluno">
                  
                  <div class="mt-3">
                    <label id="alunoDesativado" style="color: red; display: none">Desativado</label>
                    <h4 id="mostraNomeAluno">{{ $aluno->nome }}</h4>
                    <p class="text-secondary mb-1" id="mostraIdadeAluno">Idade : {{ $aluno->data_nascimento }}</p>
                    <input type="text" id="rolaTelaAbaixoAlunos" style="display: none;">
                    <label class="text-secondary mb-1" id="mostraTurmaAluno">Gênero : {{ $aluno->genero }}</label>
                    <p class="text-muted font-size-sm" id="mostraHoraEDiasAluno"></p>
                    <a class="btn btn-primary" href="{{ route('alunos.pdf', $aluno->id) }}">Baixar PDF</a>
                    <button class="btn btn-outline-primary" onclick="mostraDadosResponsaveis()">Responsáveis</button><br><br>
                    <button class="btn btn-block btn-outline-primary" onclick="addResponsavelAutorizado(document.getElementById('mostraMatriculaAluno').innerText)"><span data-feather="plus"></span> Add responsável autorizado</button>
                    <br>
                    <section id="secGeraFicha"></section>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card mb-3">
              <div class="card-body">
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">E-mail</h6>
                  </div>
                  <div class="col-sm-9 text-secondary" id="mostraEmailAluno">
                    {{ $aluno->email }}
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Telefone</h6>
                  </div>
                  <div class="col-sm-9 text-secondary" id="mostraTelefoneAluno">
                    {{ $aluno->telefone }}
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Endereço</h6>
                  </div>
                  <div class="col-sm-9 text-secondary" id="mostraEnderecoAluno">
                    {{ $aluno->endereco }}
                  </div>
                </div>
              </div>
            </div>
          </div>  
            
          </div>
        </div>
        @endforeach
       @endif
       
  @endsection