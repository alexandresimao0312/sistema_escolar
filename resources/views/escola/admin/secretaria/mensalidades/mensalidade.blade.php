@extends('escola.admin.layouts.layout')
@section('conteudo')
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form id="formListaCursos">
    <div class="container-xl">
      <div class="container">
        <form action="{{route('mensalidades.search')}}" method="get">
          @csrf
         <div class="row">
            <div class="form-group col-auto">
              <label for="inputAddress">Campo de busca</label>
              <input class="form-control" name="keyword" id="keyword"  type="search" placeholder="Digite a busca..." aria-label="Search">
            </div>
            <div class="form-group col-auto">
              <label for="inputAddress">Buscar por:</label>
              <select class="form-control" name="tipoDeBusca" id="tipoDeBusca" onchange="alteraTipoDeBusca(this.value)">
                <option selected value="id">Codigo da Mensalidade</option>
                <option value="curso_id">Curso</option>
                <option value="mes">Mes</option>
              </select>
            </div>
         </div> 
        </form>
       </div>
      <div class="table-responsive">
        <div class="table-wrapper">
          <div class="table-title">
            <div class="row">
              <div class="col-sm-6">
                <h2>Mensalidades E<b>DIVIDAS</b></h2>
              </div>
              <div class="col-sm-6">
                <a href="{{route('secretaria.mensalidades.create')}}"  class="btn btn-primary" >&nbsp; <span class="feather-24" data-feather="plus"></span><span>Adicionar</span></a>
                <a class="btn btn-success" href="{{ route('secretaria.mensalidades.exportar.pdf') }}">&nbsp; <span class="feather-24" data-feather="refresh-cw"></span><span>Exportar PDF</span></a>
              </div>
        
            </div>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>
                  
                </th>
                <th>Aluno</th>
                <th>Mês</th>
                <th>Ano</th>
                <th>Valor</th>
                <th>Estado</th>
                <th>Vencimento</th>
                <th>Pagar</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody id="listaCursos">
              @foreach ($mensalidades as $m)
              <tr>
                <td>
                  <span class="custom-checkbox">
                    <input type="checkbox" id="checkbox1" name="options[]" value="1">
                    <label for="checkbox1"></label>
                  </span>
                </td>
                <td>{{ $m->matricula->aluno->nome }}</td>
                <td>{{ $m->mes }}</td>
                <td>{{ $m->ano }}</td>
                <td>{{ number_format($m->valor, 2) }} KZ</td>
                <td>
                    <span class="badge bg-{{ $m->estado === 'pago' ? 'success' : ($m->estado === 'vencido' ? 'danger' : 'warning') }}">
                        {{ ucfirst($m->estado) }}
                    </span>
                </td>
                <td>{{ \Carbon\Carbon::parse($m->data_vencimento)->format('d/m/Y') }}</td>
                <td> 
                      @if($m->estado !== 'pago')
                    <form action="{{ route('admin.mensalidades.pagar', $m->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-success" type="submit">Marcar como paga</button>
                    </form>
                  @endif
                </td>
                 <!-- button Actions -->
                 <td>
                  <div class="dropdown-primary dropdown open">
                      <button class="btn btn-primary dropdown-toggle waves-effect waves-light " type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Actions</button>
                      <div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                          <a class="dropdown-item waves-light waves-effect" href="{{ route('secretaria.mensalidades.edit', $m->id) }}">Edit</a>
                          <a class="dropdown-item waves-light waves-effect" href="{{ route('secretaria.mensalidades.show', $m->id) }}">Ver</a>
                          <form action="{{route('secretaria.mensalidades.destroy', $m->id)}}" method="post">
                              @csrf
                              @method('delete')
                          <button class="dropdown-item waves-light waves-effect" onclick="if(confirm('DESEJAS REALMENTE EXCLUIR ESTE REGISTRO??')) {this.form.submit()}" type="button">Delet</button>
                          </form>
                         
                  </div>   
                  </td>
                   <!-- button Fim -->  
              </tr>
              @endforeach
            </tbody>
          </table>
          {{$mensalidades->links()}}
        </div>
      </div>
    </div>
  </form>

@endsection
