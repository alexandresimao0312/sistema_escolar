@extends('layouts.login') {{-- ou outro layout de login --}}

@section('content')
<div class="container">
    <h4>Verificação em dois fatores</h4>
    <p>Enviamos um código de 6 dígitos para seu e-mail.</p>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.2fa.verify') }}">
        @csrf
        <input type="text" name="2fa_code" class="form-control mb-3" placeholder="Digite o código recebido">
        <button type="submit" class="btn btn-primary w-100">Verificar</button>
    </form>
</div>
@endsection
