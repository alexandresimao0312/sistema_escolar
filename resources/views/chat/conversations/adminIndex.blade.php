@extends('escola.admin.admin.layouts.layout')
@section('conteudo')
<div class="container">
    <h3>Minhas Conversas</h3>

    @if($conversations->isEmpty())
        <p>Você não tem conversas ainda.</p>
    @else
        <ul class="list-group">

            

            @foreach($conversations as $conversation)
                @php
                    $other = $conversation->user_one_id == auth()->id() && $conversation->user_one_type == get_class(auth()->user())
                        ? $conversation->sender
                        : $conversation->receiver;

                @endphp
                <li class="list-group-item d-flex justify-content-between align-items-center">
                   <a href="{{ route('admin.chat.conversations.show', $conversation->id) }}">
                        {{ $other->nome ?? 'Usuário' }} 
                        <small class="text-muted">({{ class_basename($other) }})</small>
                         @if($other->isOnline())
                        <small class="badge bg-success" style="color: white; text-decoration: none">Online</small>
                    @else
                        <small class="badge bg-secondary" style="color: white; text-decoration: none">Offline</small>
                    @endif
                    </a>
                    <span class="text-muted small">{{ $conversation->created_at->diffForHumans() }}</span>
                </li>
            @endforeach
        </ul>
        
    @endif
</div>
    
@endsection