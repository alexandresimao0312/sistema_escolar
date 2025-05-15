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
                <h2>Gestão de Mensalidade<b></b></h2>
              </div>
              <div class="col-sm-6">
                <a href="{{ route('admin.ajustes.create') }}"  class="btn btn-primary" >&nbsp; <span class="feather-24" data-feather="plus"></span><span>Adicionar</span></a>
                <button type="submit" class="btn btn-danger" data-toggle="modal">&nbsp;<span class="feather-24" data-feather="trash"></span> <span>Deletar</span></button>						
              </div>
            </div>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Curso</th>
                <th>Classe</th>
                <th>Valor Mensalidade</th>
                <th>CRIADO EM</th>
                <th>Ações</th>
    
              </tr>
            </thead>
            <tbody id="listaCursos">
             @forelse ($ajustes as $ajuste)
              <tr>
                    <td>{{ $ajuste->curso->nome }}</td>
                    <td>{{ $ajuste->classe->nome }}</td>
                    <td>{{ number_format($ajuste->ajuste, 2, ',', '.') }}</td>
                    <td> {{$ajuste->created_at->format('d/m/Y')}} </td>
                <!-- button Actions -->
                <td>
                  <div class="dropdown-primary dropdown open">
                      <button class="btn btn-primary dropdown-toggle waves-effect waves-light " type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Actions</button>
                      <div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                          <a class="dropdown-item waves-light waves-effect" href="{{ route('admin.ajustes.edit', $ajuste->id) }}">Edit</a>                     
                          <form action="{{route('admin.ajustes.destroy', $ajuste->id)}}" method="post">
                              @csrf
                              @method('delete')
                          <button class="dropdown-item waves-light waves-effect" onclick="if(confirm('DESEJAS REALMENTE EXCLUIR ESTE REGISTRO??')) {this.form.submit()}" type="button">Delet</button>
                          </form>    
                  </div>   
                  </td>
                   <!-- button Fim -->  
              </tr>
                @empty
                <tr><td colspan="8" class="text-center">Nenhum Ajuste de Mensalidades Encontrado.</td></tr>
                @endforelse
               
            </tbody>
          </table>
        </div>
        {{ $ajustes->links() }}
      </div>
    </div>
  </form>

@endsection
