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
                <h2>Classes (Nivel Academico)<b></b></h2>
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
                <th>Curso/Nivel</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody id="listaCursos">
             @forelse ($classes as $classe)
              <tr>
                <td>{{ $classe->nome }}</td>
                <td>{{ $classe->curso->nome }}</td>
              </tr>
                @empty
                <tr><td colspan="8" class="text-center">Nenhuma Classe encontrado.</td></tr>
                @endforelse
               
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </form>

@endsection
