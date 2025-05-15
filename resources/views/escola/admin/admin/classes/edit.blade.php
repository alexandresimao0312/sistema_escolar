@extends('escola.admin.admin.layouts.layout')

@section('conteudo')
<h4>{{ isset($classe) ? 'Editar Classe' : 'Nova Classe' }}</h4>

<form action="{{ isset($classe) ? route('admin.classes.update', $classe) : route('admin.classes.store') }}" method="POST">
    @csrf
    @if(isset($classe))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>Nome da Classe</label>
        <input type="text" name="nome" class="form-control" value="{{ old('nome', $classe->nome ?? '') }}" required>
    </div>
    <div class="mb-3">
        <label>Curso</label>
        <select name="curso_id" class="form-control" required>
            <option value="">Selecione</option>
            @foreach($cursos as $curso)
                <option value="{{ $curso->id }}" {{ (old('curso_id', $classe->curso_id ?? '') == $curso->id) ? 'selected' : '' }}>
                    {{ $curso->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{ route('admin.classes.index') }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection
