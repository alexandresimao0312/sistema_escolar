@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h1 class="display-1 text-warning">404</h1>
    <h2 class="mb-4">Página Não Encontrada</h2>
    <p class="lead">Parece que você se perdeu. A página que está procurando não existe.</p>
    <a href="{{ route('home') }}" class="btn btn-primary mt-4">Ir para a Página Inicial</a>
</div>
@endsection
