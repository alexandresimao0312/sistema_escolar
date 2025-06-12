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
    
    <div class="form-group">
  <label for="curso_id">Curso</label>
  <select id="curso_id" name="curso_id" class="form-control @error('curso_id') is-invalid @enderror">
    <option value="">Selecione o Curso</option>
    @foreach($cursos as $curso)
        <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
    @endforeach
</select>
@error('curso_id')
  <div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>

<div class="form-group">
  <label for="classe_id">Classe</label>
  <select id="classe_id" name="classe_id" class="form-control @error('classe_id') is-invalid @enderror">
    <option value="">Selecione a Classe</option>
</select>
@error('classe_id')
  <div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{ route('admin.turmas.index') }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection
