@extends('errors.layout')

@section('conteudo')
<div class="container text-center mt-5">
    <h1 class="display-1 text-danger">500</h1>
    <h2 class="mb-4">Erro Interno</h2>
    <p class="lead">Ocorreu um problema no servidor. Estamos trabalhando para resolver.</p>
    <a href="{{ route('home') }}" class="btn btn-primary mt-4">Voltar para a Página Inicial</a>
</div>
@endsection
