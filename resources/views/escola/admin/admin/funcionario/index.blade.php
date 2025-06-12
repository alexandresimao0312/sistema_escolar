@extends('escola.admin.admin.layouts.layout')

@section('conteudo')
<div class="container">
    <h2>Funcionários</h2>

    <form method="GET" class="mb-4">
        <input type="text" name="search" class="form-control" placeholder="Buscar por nome, email, cargo ou data de contratação" value="{{ request('search') }}">
    </form>
    @if(session('success'))
         <div class="alert alert-success">{{ session('success') }}</div>
    @endif
       <div class="table-wrapper">
          <div class="table-title">
            <div class="row">
              <div class="col-sm-6">
                <h2>Funcionarios<b></b></h2>
              </div>
              <div class="col-sm-6">
                     <a href="{{ route('admin.funcionarios.create') }}"  class="btn btn-primary" >&nbsp; <span class="feather-24" data-feather="plus"></span><span>Adicionar</span></a>
                <button type="submit" class="btn btn-danger" data-toggle="modal">&nbsp;<span class="feather-24" data-feather="trash"></span> <span>Deletar</span></button>						
              </div>
            </div>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
              <th>Nome</th>
                <th>Email</th>
                <th>Cargo</th>
                <th>Telefone</th>
                <th>Contratado Em</th>
                <th>Salário</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody id="listaCursos">
           
               @forelse ($funcionarios as $func)
            <tr>
                <td>{{ $func->nome }}</td>
                <td>{{ $func->email }}</td>
                <td>{{ $func->cargo }}</td>
                <td>{{ $func->telefone }}</td>
                <td>{{ \Carbon\Carbon::parse($func->data_contratacao)->format('d/m/Y') }}</td>
                <td> {{ number_format($func->salario_base, 2, ',', '.') }} KZ</td>
                <!-- button Actions -->
               <td>
                <div class="dropdown-primary dropdown open">
                    <button class="btn btn-primary dropdown-toggle waves-effect waves-light " type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Actions</button>
                    <div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                        <a class="dropdown-item waves-light waves-effect" href="{{ route('admin.funcionarios.edit', $func->id) }}">Edit</a>
                        <form action="{{route('admin.funcionarios.destroy', $func->id)}}" method="post">
                            @csrf
                            @method('delete')
                        <button class="dropdown-item waves-light waves-effect" onclick="if(confirm('DESEJAS REALMENTE EXCLUIR ESTE REGISTRO??')) {this.form.submit()}" type="button">Delet</button>
                        </form>
                       
                </div>   
                </td>
                 <!-- button Fim --> 
            </tr>
                @empty
                <tr><td colspan="8" class="text-center">Nenhum funcionario encontrado.</td></tr>
                @endforelse
               
            </tbody>
          </table>
              {{ $funcionarios->links() }}
        </div>
</div>
@endsection
