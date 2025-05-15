@extends('escola.admin.admin.layouts.layout')

@section('conteudo')
<h4>Editar Usuário da Secretaria</h4>

<form method="POST" action="{{ route('admin.secretarias.update', $secretaria->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="nome" class="form-control" value="{{ $secretaria->nome }}" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $secretaria->email }}" required>
    </div>

    <div class="mb-3">
        <label>Nova Senha (opcional)</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="mb-3">
        <label>Confirmar Senha</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>

    <button class="btn btn-primary">Atualizar</button>
</form>
@endsection
