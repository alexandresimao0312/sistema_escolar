@extends('escola.admin.admin.layouts.layout')

@section('conteudo')
<h4>Criar Usuário da Secretaria</h4>

<form method="POST" action="{{ route('admin.secretarias.store') }}">
    @csrf
    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{old('nome')}}">
        @error('nome')
      <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}">
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
          @enderror
    </div>

    <div class="mb-3">
        <label>Senha</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
        @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
          @enderror
    </div>

    <div class="mb-3">
        <label>Confirmar Senha</label>
        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
        @error('password_confirmation')
        <div class="invalid-feedback">{{ $message }}</div>
          @enderror
    </div>

    <button class="btn btn-primary">Criar Secretario(a)</button>
</form>
@endsection
