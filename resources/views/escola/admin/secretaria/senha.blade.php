@extends('escola.admin.layouts.layout')

@section('conteudo')
    <h4>Alterar Senha</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('secretaria.secretaria.perfil.senha.update') }}">
        @csrf

        <div class="mb-3">
            <label for="senha_atual">Senha Atual</label>
            <input type="password" name="senha_atual" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="nova_senha">Nova Senha</label>
            <input type="password" name="nova_senha" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="nova_senha_confirmation">Confirme a Nova Senha</label>
            <input type="password" name="nova_senha_confirmation" class="form-control" required>
        </div>

        <button class="btn btn-primary">Atualizar Senha</button>
    </form>
@endsection
