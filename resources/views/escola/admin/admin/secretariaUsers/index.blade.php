@extends('escola.admin.admin.layouts.layout')
@section('conteudo')
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form id="formListaCursos">
    <div class="container-xl">
      <div class="table-responsive">
        <div class="container">
          <form method="get">
            @csrf
           <div class="row">
              <div class="form-group col-auto ">
                <label for="inputAddress">Campo de busca</label>
                <div  style="display: flex; justify-content: space-between">
                  <input class="form-control" name="busca" value="{{ $busca }}" placeholder="Buscar nome ou email..." aria-label="Search">
                <button type="submit" class="btn btn-primary" style="margin-left: 4px">Buscar</button>
                </div>
              </div>
           </div> 
          </form>
         </div>
        <div class="table-wrapper">
          <div class="table-title">
            <div class="row">
              <div class="col-sm-6">
                <h2>Usuários da Secretaria<b></b></h2>
              </div>
              <div class="col-sm-6">
                <a href="{{route('admin.secretarias.create')}}"  class="btn btn-primary" >&nbsp; <span class="feather-24" data-feather="plus"></span><span>Adicionar</span></a>
                <button type="submit" class="btn btn-danger" data-toggle="modal">&nbsp;<span class="feather-24" data-feather="trash"></span> <span>Deletar</span></button>						
              </div>
            </div>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
              
                <th>Nome</th>
                <th>Email</th>
                <th>Status</th>
                <th>Ativar/Desativar</th>
                <th>Ação</th>
                
              </tr>
            </thead>
            <tbody id="listaCursos">
             @forelse ($secretarias as $s )
              <tr>
                <td>{{ $s->nome }}</td>
                <td>{{ $s->email }}</td>
                <td>
                    @if($s->ativo)
                        <span class="badge bg-success">Ativo</span>
                    @else
                        <span class="badge bg-danger">Inativo</span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('admin.secretarias.ativar', $s->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-sm {{ $s->ativo ? 'btn-danger' : 'btn-success' }}">
                            {{ $s->ativo ? 'Desativar' : 'Ativar' }}
                        </button>
                    </form>
                </td>
                <!-- button Actions -->
                <td>
                  <div class="dropdown-primary dropdown open">
                      <button class="btn btn-primary dropdown-toggle waves-effect waves-light " type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Actions</button>
                      <div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                          <a class="dropdown-item waves-light waves-effect" href="{{ route('admin.secretarias.edit', $s->id) }}">Edit</a>                     
                          <form action="{{route('admin.secretarias.destroy', $s->id)}}" method="post">
                              @csrf
                              @method('delete')
                          <button class="dropdown-item waves-light waves-effect" onclick="if(confirm('DESEJAS REALMENTE EXCLUIR ESTE REGISTRO??')) {this.form.submit()}" type="button">Delet</button>
                          </form>    
                  </div>   
                  </td>
                   <!-- button Fim -->  
              </tr>
                @empty
                <tr><td colspan="8" class="text-center">Nenhum Secretario encontrado.</td></tr>
                @endforelse
               
            </tbody>
          </table>
        </div>
        {{ $secretarias->links() }}
      </div>
    </div>
  </form>

@endsection
