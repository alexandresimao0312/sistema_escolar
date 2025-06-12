@extends('escola.admin.admin.layouts.layout') {{-- Ou o layout do módulo (secretaria, admin, etc.) --}}

@section('conteudo')
<div class="container">
    <h4>Iniciar nova conversa</h4>
    <form action="{{ route('admin.chat.conversations.store') }}" method="POST">
        @csrf

        <div class="form-group mt-2">
    <label for="user_two_type">Tipo de Usuário</label>
    <select name="user_two_type" id="receiver_type" class="form-control" required>
        <option value="">-- Escolher tipo --</option>
        <option value="App\Models\Secretaria">Secretaria</option>
        <option value="App\Models\Admin">Admin</option>
        <option value="App\Models\Professor">Professor</option>
    </select>
</div>

<div class="form-group mt-2">
    <label for="user_two_id">Usuário</label>
    <select name="user_two_id" id="receiver_id" class="form-control" required></select>
</div>

        <div class="form-group mt-2">
            <label for="body">Mensagem inicial</label>
            <textarea name="body" class="form-control" required></textarea>
        </div>

        <button class="btn btn-primary mt-3">Enviar</button>
    </form>
</div>
@endsection

