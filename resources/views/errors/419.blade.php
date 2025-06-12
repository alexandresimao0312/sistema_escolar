@extends('errors.layout')

@section('conteudo')
<div class="container text-center mt-5">
    <h1 class="display-1 text-danger">419</h1>
    <h2 class="mb-4">Pagina Expirada</h2>
    <p class="lead">A sua secção foi expirada. Faz o login novamente.</p>
    <a href="{{ route('home') }}" class="btn btn-primary mt-4">Voltar para a Página Inicial</a>
</div>
@endsection
