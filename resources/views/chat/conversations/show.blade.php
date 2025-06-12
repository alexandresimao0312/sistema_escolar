@extends('escola.admin.layouts.layout')

@section('conteudo')
<div class="container">
  
    @php
    $authUser = auth('secretaria')->user() ?? auth('admin')->user() ?? auth()->user();
    $userType = $authUser ? get_class($authUser) : null;
    @endphp
    
<div class="border rounded p-3 mb-3" style="height: 400px; overflow-y: auto;">
    @forelse($conversation->messages as $message)
        <div class="mb-2 {{ ($message->user_one_id === $authUser?->id && $message->user_one_type === $userType) ? 'text-end' : '' }}">
            <strong>{{ $message->sender->nome ?? 'Você' }}</strong><br>
            <span class="badge bg-light text-dark primary">{{ $message->body }}</span><br>
            <small class="text-muted">{{ $message->created_at->format('d/m/Y H:i') }}</small>
        </div>
    @empty
        <p class="text-muted">Nenhuma mensagem nesta conversa.</p>
    @endforelse
</div>

    <form action="{{ route('messages.store', $conversation->id) }}" method="POST">
        @csrf
        <div class="input-group">
            <input type="text" name="body" class="form-control" placeholder="Digite sua mensagem..." required>
            <button class="btn btn-primary" type="submit">Enviar</button>
        </div>
    </form>
</div>
@endsection
