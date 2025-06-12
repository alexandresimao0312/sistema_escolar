@extends('escola.admin.admin.layouts.layout')

@section('title', 'Novo Tutorial de Ajuda')

@section('conteudo')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <h2 class="mb-4">
                <i class="bi bi-journal-plus me-2"></i>
                Criar Novo Tutorial
            </h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Ops!</strong> Corrija os erros abaixo:
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('ajuda.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="titulo" class="form-label">Título *</label>
                    <input type="text" name="titulo" class="form-control" value="{{ old('titulo') }}" required>
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição breve *</label>
                    <input type="text" name="descricao" class="form-control" value="{{ old('descricao') }}" required>
                </div>

                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoria (opcional)</label>
                    <input type="text" name="categoria" class="form-control" value="{{ old('categoria') }}">
                </div>

                <div class="mb-3">
                    <label for="video_url" class="form-label">URL do vídeo (YouTube, Vimeo, etc.)</label>
                    <input type="url" name="video_url" class="form-control" value="{{ old('video_url') }}">
                </div>

                <div class="mb-3">
                    <label for="conteudo" class="form-label">Conteúdo detalhado *</label>
                    <textarea name="conteudo" rows="8" class="form-control" required>{{ old('conteudo') }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('ajuda.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Voltar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Salvar Tutorial
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
