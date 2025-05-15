@extends('escola.admin.admin.layouts.layout')
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
                <a href="{{route('admin.classes.create')}}"  class="btn btn-primary" >&nbsp; <span class="feather-24" data-feather="plus"></span><span>Adicionar</span></a>
                <button type="submit" class="btn btn-danger" data-toggle="modal">&nbsp;<span class="feather-24" data-feather="trash"></span> <span>Deletar</span></button>						
              </div>
            </div>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Curso/Nivel</th>
                <th>Criado Em</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody id="listaCursos">
             @forelse ($classes as $classe)
              <tr>
                <td>{{ $classe->nome }}</td>
                <td>{{ $classe->curso->nome }}</td>
                <td>{{$classe->created_at->format('d/m/Y á\s H\hi')}}</td>
               <!-- button Actions -->
               <td>
                <div class="dropdown-primary dropdown open">
                    <button class="btn btn-primary dropdown-toggle waves-effect waves-light " type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Actions</button>
                    <div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                        <a class="dropdown-item waves-light waves-effect" href="{{ route('admin.classes.edit', $classe->id) }}">Edit</a>
                        <form action="{{route('admin.classes.destroy', $classe->id)}}" method="post">
                            @csrf
                            @method('delete')
                        <button class="dropdown-item waves-light waves-effect" onclick="if(confirm('DESEJAS REALMENTE EXCLUIR ESTE REGISTRO??')) {this.form.submit()}" type="button">Delet</button>
                        </form>
                       
                </div>   
                </td>
                 <!-- button Fim -->  
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
