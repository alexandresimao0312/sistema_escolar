@extends('escola.admin.layouts.layout')
@section('conteudo')
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form id="formListaCursos">
    <div class="container-xl">
      <div class="table-responsive">
        <div class="table-wrapper">
          <div class="table-title">
            <div class="row">
              <div class="col-sm-6">
                <h2>Usuários da Secretaria<b></b></h2>
              </div>
              <div class="col-sm-6">
                <button type="submit" class="btn btn-danger" data-toggle="modal">&nbsp;<span class="feather-24" data-feather="trash"></span> <span>Deletar</span></button>			
              </div>
            </div>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Ano</th>
                <th>Classe</th>
                <th>Curso</th>
                <th>Limite/Turma</th>
    
              </tr>
            </thead>
            <tbody id="listaCursos">
             @forelse ($turmas as $turma )
              <tr>
                <td>{{ $turma->nome }}</td>
                <td>{{ $turma->ano_letivo - 1}}/{{ $turma->ano_letivo }}</td>
                <td>{{ $turma->classe->nome }}</td>
                <td>{{ $turma->curso->nome }}</td> 
                <td>({{ $turma->matriculas_count ?? 0 }}/{{ $turma->limite_alunos }})</td> 
              </tr>
                @empty
                <tr><td colspan="8" class="text-center">Nenhuma Turma encontrado.</td></tr>
                @endforelse
               
            </tbody>
          </table>
        </div>
        {{ $turmas->links() }}
      </div>
    </div>
  </form>

@endsection
