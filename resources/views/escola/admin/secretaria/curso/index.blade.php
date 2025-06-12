@extends('escola.admin.layouts.layout')
@section('conteudo')
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form id="formListaCursos">
    <div class="container-xl">
      <div class="table-responsive">
        <div class="container">
          <form action="{{route('pagamentos.search')}}" method="get">
            @csrf
           <div class="row">
              <div class="form-group col-auto">
                <label for="inputAddress">Campo de busca</label>
                <input class="form-control" name="keyword" id="keyword"  type="search" placeholder="Digite a busca..." aria-label="Search">
              </div>
              <div class="form-group col-auto">
                <label for="inputAddress">Buscar por:</label>
                <select class="form-control" name="tipoDeBusca" id="tipoDeBusca" onchange="alteraTipoDeBusca(this.value)">
                  <option selected value="id">Codigo do Curso</option>
                  <option value="tipo">Nivel Academico</option>
                  <option value="valor_mensalidade">Mensalidade</option>
                </select>
              </div>
           </div> 
          </form>
         </div>
        <div class="table-wrapper">
          <div class="table-title">
            <div class="row">
              <div class="col-sm-6">
                <h2>Nivel Academico e Cursos<b></b></h2>
              </div>
              <div class="col-sm-6">
                <button type="submit" class="btn btn-danger" data-toggle="modal">&nbsp;<span class="feather-24" data-feather="trash"></span> <span>Deletar</span></button>						
              </div>
            </div>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>
                  
                </th>
                <th>Nome</th>
                <th>Nivel</th>
                <th>Mensalidade</th>
                <th>Estado</th>
                <th>CRIADO EM</th>
              
              </tr>
            </thead>
            <tbody id="listaCursos">
             @forelse ( $cursos as $c )
              <tr>
                <td>
                  <span class="custom-checkbox">
                    <input type="checkbox" id="checkbox1" name="options[]" value="1">
                    <label for="checkbox1"></label>
                  </span>
                </td>
                <td>{{ $c->nome}}</td>
                <td>{{ $c->tipo}}</td>
                <td>{{ $c->valor_mensalidade}}</td>
                <td>
                    <button type="submit" class="btn btn-sm {{ $c->ativo ? 'btn-success' : 'btn-danger' }}">
                        {{ $c->ativo ? 'Ativado' : 'Desativado' }}
                    </button>
                </td>
                 <td>{{$c->created_at->format('d/m/Y')}}</td>
          
              </tr>
                @empty
                <tr><td colspan="8" class="text-center">Nenhum Curso encontrado.</td></tr>
                @endforelse
               
            </tbody>
          </table>
          {{$cursos->links()}}
        </div>
      </div>
    </div>
  </form>

@endsection
