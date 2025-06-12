@extends('escola.admin.admin.layouts.layout')

@section('title', 'Conversa')

@section('conteudo')
<div class="container py-3">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                Conversa com: 
                {{ $conversation->sender->id === auth()->id() && get_class($conversation->sender) === get_class(auth()->user()) 
                    ? $conversation->receiver->nome ?? 'Usuário' 
                    : $conversation->sender->nome ?? 'Usuário' }}
            </h5>
        </div>

        <div class="card-body p-0" style="height: 500px; overflow-y: auto;" id="chat-box">
            <div class="p-3">
                @foreach($conversation->messages as $message)
 
    @php
    $authUser = auth('secretaria')->user() ?? auth('admin')->user() ?? auth()->user();
    $userType = $authUser ? get_class($authUser) : null;
    @endphp

    <div class="mb-2 {{ $authUser ? 'text-end' : '' }}">
        <strong>{{ $message->sender->nome ?? 'Você' }}</strong><br>
        
        <div class="d-inline-block bg-light rounded px-3 py-2 d-flex justify-content-between align-items-center">
            <span id="message-body-{{ $message->id }}">{{ $message->body }}</span>

            @if($authUser)
                <div class="top-0 end-0 m-1">
                    <button class="btn btn-sm btn-outline-secondary btn-edit" 
                            data-id="{{ $message->id }}" 
                            data-body="{{ $message->body }}">
                        ✏️
                    </button>
                    <form action="{{ route('chat.messages.destroy', $message) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">🗑️</button>
                    </form>
                </div>
            @endif
        </div><br>
        <small class="text-muted">{{ $message->created_at->format('d/m/Y H:i') }}</small>
    </div>
@endforeach
            </div>
        </div>

        <div class="card-footer bg-white chat-messages">
            <form action="{{ route('admin.messages.store', $conversation->id) }}" method="POST" class="d-flex">
                @csrf
                <input type="text" name="body" class="form-control me-2" placeholder="Digite sua mensagem..." required>
                <button type="submit" class="btn btn-success" style="margin-left: 5px"><i class="bi bi-send-fill"></i></button>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="editMessageModal" tabindex="-1" aria-labelledby="editMessageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="edit-message-form" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Mensagem</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <textarea name="body" id="edit-message-body" class="form-control" rows="4" required></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
  </div>
</div>
@push('script')
    <script>
    Echo.channel('conversation.{{ $conversation->id }}')
        .listen('.message.sent', (e) => {
            const message = e.message;
            const container = document.createElement('div');

            const isOwn = message.sender_id == " auth('secretaria')->user() ?? auth('admin')->user() ?? auth()->user()" &&
                          message.sender_type == "{{$authUser ? get_class($authUser) : null}}";

            container.classList.add('mb-2');
            if (isOwn) container.classList.add('text-end');

            container.innerHTML = `
                <strong>${message.sender?.nome ?? 'Você'}</strong><br>
                <div class="d-inline-block bg-light rounded px-3 py-2">
                    ${message.body}
                </div><br>
                <small class="text-muted">${new Date(message.created_at).toLocaleString()}</small>
            `;

            document.querySelector('.chat-messages').appendChild(container);
        });
</script>
@endpush
@endsection
