@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h1 class="display-1 text-danger">403</h1>
    <h2 class="mb-4">Acesso Negado</h2>
    <p class="lead">Desculpe, você não tem permissão para acessar esta página.</p>
    <a href="{{ route('home') }}" class="btn btn-primary mt-4">Voltar para a Página Inicial</a>
</div>
@endsection
