@extends('layouts.login')

@section('title', 'Login Secretaria')

@section('content')
    <div class="text-center mb-4">
        <i class="fas fa-user-shield fa-3x text-primary mb-2"></i>
        <h4 class="fw-bold">Secretaria - Acesso ao Sistema</h4>
    </div>

    @if(session('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('errors') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('secretaria.login') }}" id="loginForm">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label"><i class="fas fa-envelope me-2"></i>E-mail</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror " name="email" id="email" autofocus value="{{old('email')}}">
             @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
             @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label"><i class="fas fa-lock me-2"></i>Senha</label>
            <input type="password" class="form-control" name="password" id="password" >
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-sign-in-alt me-2"></i>Entrar
            </button>
        </div>

         <div class="text-center mt-3">
            <a href="{{ route('login.opcao') }}" class="text-muted">
                <i class="fas fa-arrow-left"></i> Voltar à tela de seleção
            </a>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('loginForm');
        form.addEventListener('submit', function () {
            const btn = form.querySelector('button[type="submit"]');
            btn.disabled = true;
            btn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status"></span>Entrando...`;
        });

        // Animação simples de foco
        const inputs = form.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', () => input.classList.add('border-primary'));
            input.addEventListener('blur', () => input.classList.remove('border-primary'));
        });
    });
</script>
@endpush
