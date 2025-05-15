@extends('escola.admin.layouts.layout')

@section('conteudo')
    <div class="card">
        <div class="card-header">Notificações</div>
        <div class="card-body">
            @forelse ($notificacoes as $notificacao)
                <div class="alert alert-info">
                    {{ $notificacao->data['mensagem'] ?? 'Notificação' }} <br>
                    <small>{{ $notificacao->created_at->diffForHumans() }}</small>
                </div>
            @empty
                <p>Nenhuma notificação encontrada.</p>
            @endforelse

            {{ $notificacoes->links() }}
        </div>
    </div>
@endsection
