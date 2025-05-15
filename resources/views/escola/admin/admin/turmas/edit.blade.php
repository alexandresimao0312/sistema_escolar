@extends('escola.admin.admin.layouts.layout')

@section('conteudo')
<h4>{{ isset($turma) ? 'Editar Turma' : 'Nova Turma' }}</h4>

<form action="{{ isset($turma) ? route('admin.turmas.update', $turma) : route('admin.turmas.store') }}" method="POST">
    @csrf
    @if(isset($turma))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="nome" class="form-control" value="{{ old('nome', $turma->nome ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Ano</label>
        <input type="number" name="ano_letivo" class="form-control" value="{{ old('ano_letivo', $turma->ano_letivo ?? date('Y')) }}" required>
    </div>

    <div class="mb-3">
        <label>Classe</label>
        <select name="classe_id" class="form-control" required>
            <option value="">Selecione</option>
            @foreach($classes as $classe)
                <option value="{{ $classe->id }}" {{ (old('classe_id', $turma->classe_id ?? '') == $classe->id) ? 'selected' : '' }}>
                    {{ $classe->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Curso</label>
        <select name="curso_id" class="form-control" required>
            <option value="">Selecione</option>
            @foreach($cursos as $curso)
                <option value="{{ $curso->id }}" {{ (old('curso_id', $turma->curso_id ?? '') == $curso->id) ? 'selected' : '' }}>
                    {{ $curso->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{ route('admin.turmas.index') }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection
