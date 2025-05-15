@extends('escola.admin.layouts.layout')
@section('conteudo')
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

 <div class="container">
      <form method="GET" action="{{ route('secretaria.pagamentos.index') }}" class="mb-4 row g-3">
        <div class="col-md-3">
            <input type="text" name="nome" class="form-control" placeholder="Nome do aluno" value="{{ request('nome') }}">
        </div>
    
        <div class="col-md-3">
            <select name="forma_pagamento" class="form-control">
                <option value="">-- Forma de Pagamento --</option>
                 <option value="Dinheiro" {{ request('forma_pagamento') == 'Dinheiro' ? 'selected' : ''}}>Dinheiro</option>
                <option value="Transferência" {{ request('forma_pagamento') == 'Transferência' ? 'selected' : ''}}>Transferência</option>
                <option value="POS" {{ request('forma_pagamento') == 'POS' ? 'selected' : ''}}>POS</option>
                <option value="Multicaixa Express" {{ request('forma_pagamento') == 'Multicaixa Express' ? 'selected' : ''}}>Multicaixa Express</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="date" name="data_pagamento" id="" class="form-control" value="{{ request('data_pagamento') }}">
        </div>
    
        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('secretaria.pagamentos.index') }}" class="btn btn-secondary ms-2" style="margin-left: 4px">Limpar</a>
        </div>
    </form>
     </div>

        <div class="table-wrapper">
          <div class="table-title">
            <div class="row">
              <div class="col-sm-6">
                <h2>Pagamentos<b></b></h2>
              </div>
              <div class="col-sm-6">
                <a href="{{route('secretaria.pagamentos.create')}}"  class="btn btn-primary" >&nbsp; <span class="feather-24" data-feather="plus"></span><span>Adicionar</span></a>
                <a class="btn btn-success" href="{{ route('secretaria.pagamentos.exportar.pdf') }}">&nbsp; <span class="feather-24" data-feather="refresh-cw"></span><span>Exportar PDF</span></a>
                				
              </div>
            </div>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>
                  
                </th>
                <th>Aluno</th>
                <th>Curso</th>
                <th>Valor Pago</th>
                <th>Mês/Ano</th>
                <th>Data</th>
                <th>Estado</th>
                <th>Comprovativo</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody id="listaCursos">
             @forelse ( $pagamentos as $pagamento )
              <tr>
                <td>
                  <span class="custom-checkbox">
                    <input type="checkbox" id="checkbox1" name="options[]" value="1">
                    <label for="checkbox1"></label>
                  </span>
                </td>
                <td>{{ $pagamento->mensalidade->matricula->aluno->nome ?? 'Desconhecido' }}</td>
                <td>{{ $pagamento->mensalidade->matricula->curso->nome ?? '-' }}</td>
                <td>{{ number_format($pagamento->valor_pago, 2, ',', '.') }} Kz</td>
                <td>{{$pagamento->mensalidade->mes}}/{{$pagamento->mensalidade->ano}}</td>
                <td>{{ \Carbon\Carbon::parse($pagamento->data_pagamento)->format('d/m/Y') }}</td>
                <td>
                  @if ($pagamento->mensalidade->estado == "pago")
                  <span class="badge bg-success"> pago </span>
                  @else
                  <span class="badge bg-danger"> pendente </span>
                  @endif

                </td>
                <td>
                    <a href="{{ route('pagamentos.comprovativo', $pagamento->id) }}" class="btn btn-sm btn-primary">Comprovativo</a>
                </td>
                </td>
                 <!-- button Actions -->
                 <td>
                  <div class="dropdown-primary dropdown open">
                      <button class="btn btn-primary dropdown-toggle waves-effect waves-light " type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Actions</button>
                      <div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                          <a class="dropdown-item waves-light waves-effect" href="{{ route('secretaria.pagamentos.edit', $pagamento->id) }}">Edit</a>
                          <form action="{{route('secretaria.pagamentos.destroy', $pagamento->id)}}" method="post">
                              @csrf
                              @method('delete')
                          <button class="dropdown-item waves-light waves-effect" onclick="if(confirm('DESEJAS REALMENTE EXCLUIR ESTE REGISTRO??')) {this.form.submit()}" type="button">Delet</button>
                          </form>
                         
                  </div>   
                  </td>
                   <!-- button Fim -->  
              </tr>
                @empty
                <tr><td colspan="8" class="text-center">Nenhum pagamento encontrado.</td></tr>
                @endforelse
               
            </tbody>
          </table>
          {{$pagamentos->links()}}
        </div>
      </div>
    </div>
  </form>

@endsection
