@extends('escola.admin.admin.layouts.layout')

@section('conteudo')
<h1>Logs de Atividades</h1>

{{-- Filtros --}}
    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-2">
            <input type="text" name="ip" class="form-control" placeholder="IP" value="{{ request('ip') }}">
        </div>
        <div class="col-md-2">
            <select name="usuario_tipo" class="form-control">
                <option value="">Tipo</option>
                <option value="admin" {{ request('usuario_tipo') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="secretaria" {{ request('usuario_tipo') == 'secretaria' ? 'selected' : '' }}>Secretaria</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="text" name="evento" class="form-control" placeholder="Evento" value="{{ request('evento') }}">
        </div>
        <div class="col-md-2">
            <input type="date" name="data_de" class="form-control" value="{{ request('data_de') }}">
        </div>
        <div class="col-md-2">
            <input type="date" name="data_ate" class="form-control" value="{{ request('data_ate') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </form>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Usuário</th>
            <th>Evento</th>
            <th>IP</th>
            <th>Navegador</th>
            <th>Data</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
            <tr>
                <td>{{ $log->id }}</td>
                <td>{{ ucfirst($log->user_type) }}</td>
                <td>{{ $log->user_id ?? '-' }}</td>
                <td>{{ $log->event }}</td>
                <td>{{ $log->ip_address }}</td>
                <td>{{ Str::limit($log->user_agent, 40) }}</td>
                <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $logs->links() }}
@endsection
