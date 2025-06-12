
@extends('escola.admin.admin.layouts.layout')

@section('conteudo')
<div class="container">
    <h2>Salários</h2>
  
<form method="GET" class="row g-3 mb-3">
    <div class="col-md-4">
        <input type="text" name="nome" class="form-control" placeholder="Nome do funcionário" value="{{ $filtros['nome'] ?? '' }}">
    </div>

    <div class="col-md-3">
        <input type="date" name="created_at" class="form-control" value="{{ $filtros['created_at'] ?? '' }}">
    </div>

    <div class="col-md-3">
        <button type="submit" class="btn btn-primary">Filtrar</button>
        <a href="{{ route('admin.salarios.index') }}" class="btn btn-secondary">Limpar</a>
    </div>
</form>
    @if(session('success'))
         <div class="alert alert-success">{{ session('success') }}</div>
    @endif
       <div class="table-wrapper">
          <div class="table-title">
            <div class="row">
              <div class="col-sm-6">
                <h2>Registro de Salários<b></b></h2>
              </div>
              <div class="col-sm-6">
                     <a href="{{ route('admin.salarios.create') }}"  class="btn btn-primary" >&nbsp; <span class="feather-24" data-feather="plus"></span><span>Pagar Salários</span></a>
                
              </div>
            </div>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                    <th>Funcionário</th>
                    <th>Salário Base</th>
                    <th>Bônus</th>
                    <th>Descontos</th>
                    <th>Total Recebido</th>
                    <th>Mês Referente</th>
                    <th>Data Pagamento</th>
                    <th>Recibo</th>
              </tr>
            </thead>
            <tbody id="listaCursos">
           
               @forelse ($salarios as $salario)
            <tr>
               <td>{{ $salario->funcionario->nome }}</td>
                <td>{{ number_format($salario->salario_base, 2, ',', '.') }}</td>
                <td>{{ number_format($salario->bonus, 2, ',', '.') }}</td>
                <td>{{ number_format($salario->descontos, 2, ',', '.') }}</td>
                <td><strong>{{ number_format($salario->total_recebido, 2, ',', '.') }}</strong></td>
                <td>{{ \Carbon\Carbon::parse( $salario->referente_mes)->format('m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($salario->created_at)->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('salarios.recibo', $salario->id) }}" class="btn btn-sm btn-primary" target="_blank">Comprovativo</a>

                </td>
            </tr>
             @empty
            <tr>
                <td colspan="7">Nenhum pagamento de salário encontrado.</td>
            </tr>
        @endforelse
            </tbody>
          </table>
            {{ $salarios->withQueryString()->links() }}
        </div>
</div>
@endsection
