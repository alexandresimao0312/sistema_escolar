
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
                <h2>Historico de Actividade<b></b></h2>
              </div>
            </div>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Data</th>
                <th>Nome da Secretaria</th>
                <th>Ação</th>
                <th>Detalhes</th>
              </tr>
            </thead>
            <tbody id="listaCursos">
             @forelse ($logs as $log )
              <tr>
                <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $log->secretaria->nome }}</td>
                 <td>{{ $log->acao }}</td>
                <td>{{ $log->detalhes ?? '-' }}</td>          
              </tr>
                @empty
                <div class="p-3">Nenhuma atividade registrada.</div>
                @endforelse
               
            </tbody>
          </table>
          <div class="mt-3 px-3">
            {{ $logs->links() }}
        </div>
        </div>
      </div>
    </div>
  </form>

@endsection

