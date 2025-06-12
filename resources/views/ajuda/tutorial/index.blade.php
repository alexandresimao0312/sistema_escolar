@extends('escola.admin.admin.layouts.layout')

@section('title', 'Central de Ajuda')

@section('conteudo')
<h2 class="mb-4">Central de Ajuda</h2>

<div class="mb-3">
    <a href="{{ route('admin.ajuda.create') }}" class="btn btn-primary">+ Novo Tutorial</a>
</div>

<div class="row">
    @foreach ($tutoriais as $tutorial)
        <div class="col-md-6 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5>{{ $tutorial->titulo }}</h5>
                    <p class="text-muted">{{ Str::limit($tutorial->descricao, 100) }}</p>
                    <!-- Botão para abrir o modal -->
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editTutorialModal-{{ $tutorial->id }}">
                    <i class="bi bi-pencil-square"></i> Editar
                </button>
                    <form action="{{ route('admin.ajuda.destroy', $tutorial) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{ $tutoriais->links() }}

<!-- Modal -->
<div class="modal fade"  id="editTutorialModal-{{ $tutorial->id }}" tabindex="-1" aria-labelledby="editTutorialModalLabel-{{ $tutorial->id }}" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            
            <form method="POST" action="{{ route('admin.ajuda.update', $tutorial->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="editTutorialModalLabel-{{ $tutorial->id }}">
                        <i class="bi bi-pencil-square me-2"></i> Editar Tutorial
                    </h5>
                    <div>
                         <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-1"></i> Salvar Alterações
                    </button>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="mb-2">
                        <label class="form-label">Título *</label>
                        <input type="text" name="titulo" class="form-control" value="{{ $tutorial->titulo }}" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Descrição *</label>
                        <input type="text" name="descricao" class="form-control" value="{{ $tutorial->descricao }}" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Categoria</label>
                        <input type="text" name="categoria" class="form-control" value="{{ $tutorial->categoria }}">
                    </div>

                    <div class="mb-2">
                        <label class="form-label">URL do Vídeo</label>
                        <input type="url" name="video_url" class="form-control" value="{{ $tutorial->video_url }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Conteúdo *</label>
                        <textarea name="conteudo" class="form-control" rows="6" required>{{ $tutorial->conteudo }}</textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-1"></i> Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
