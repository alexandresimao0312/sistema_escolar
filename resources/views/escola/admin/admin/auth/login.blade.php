@extends('layouts.login')

@section('title', 'Login do Administrador')

@section('content')
<div class="login-container">
    <div class="login-box">
        <div class="text-center mb-4">
            <i class="fas fa-user-shield fa-3x text-primary mb-3"></i>
            <h3>Administrador</h3>
            <p>Entre com as suas credenciais</p>
        </div>

        @if(session('errors'))
           <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('errors') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <div class="form-group mb-3">
               <label for="email" class="form-label"><i class="fas fa-envelope me-2"></i>E-mail</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>

            <div class="form-group mb-3">
                <label for="password"><i class="fas fa-lock"></i> Senha</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-sign-in-alt"></i> Entrar
            </button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('login.opcao') }}" class="text-muted">
                <i class="fas fa-arrow-left"></i> Voltar à tela de seleção
            </a>
        </div>
    </div>
</div>
@endsection
