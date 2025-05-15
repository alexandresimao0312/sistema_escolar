@extends('layouts.app') {{-- Use um layout limpo e sem autenticação --}}

@section('title', 'Escolher Tipo de Login')

@section('content')
<div class="container d-flex flex-column justify-content-center align-items-center" style="min-height: 100vh;">
    <h2 class="mb-4">Escolha o Tipo de Login</h2>

    <div class="row w-100 justify-content-center">

        <!-- Secretaria -->
        <div class="col-6 col-md-3 mb-4">
            <a href="{{ route('secretaria.login') }}" class="card text-center shadow-sm h-100 login-option">
                <div class="card-body">
                    <i class="fas fa-user-tie fa-3x mb-3 text-primary"></i>
                    <h5 class="card-title">Secretaria</h5>
                </div>
            </a>
        </div>

        <!-- Administrador -->
        <div class="col-6 col-md-3 mb-4">
            <a href="{{ route('admin.login') }}" class="card text-center shadow-sm h-100 login-option">
                <div class="card-body">
                    <i class="fas fa-user-shield fa-3x mb-3 text-dark"></i>
                    <h5 class="card-title">Administrador</h5>
                </div>
            </a>
        </div>

        <!-- Professor -->
        <div class="col-6 col-md-3 mb-4">
            <a href="" class="card text-center shadow-sm h-100 login-option">
                <div class="card-body">
                    <i class="fas fa-chalkboard-teacher fa-3x mb-3 text-success"></i>
                    <h5 class="card-title">Professor</h5>
                </div>
            </a>
        </div>

        <!-- Aluno -->
        <div class="col-6 col-md-3 mb-4">
            <a href="" class="card text-center shadow-sm h-100 login-option">
                <div class="card-body">
                    <i class="fas fa-user-graduate fa-3x mb-3 text-info"></i>
                    <h5 class="card-title">Aluno</h5>
                </div>
            </a>
        </div>

    </div>
</div>

<style>
    .login-option {
        text-decoration: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .login-option:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection
