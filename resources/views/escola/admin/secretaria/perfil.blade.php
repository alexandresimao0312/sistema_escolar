@extends('escola.admin.layouts.layout')

@section('conteudo')
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
<div class="card">
    <div class="card-header">Meu Perfil</div>
    <div class="card-body">
        <form action="{{ route('secretaria.secretaria.perfil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" value="{{ old('nome', $secretaria->nome) }}">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $secretaria->email) }}">
            </div>

            <div class="mb-3">
                <label>Foto de Perfil</label>
                <input type="file" name="foto" class="form-control">
                @if($secretaria->foto)
                    <img src="{{ asset('storage/' . $secretaria->foto) }}" width="100" class="mt-2">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Perfil</button>
        </form>
    </div>
</div>
@endsection
