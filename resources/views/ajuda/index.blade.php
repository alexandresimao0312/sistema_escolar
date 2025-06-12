@extends('layouts.ajuda') {{-- ou outro layout público --}}

@section('title', 'Central de Ajuda')

@section('conteudo')
<div class="container py-5">
    <h2 class="mb-4">Central de Ajuda</h2>

        <!-- campo de pergunta -->
        <form id="form-ajuda" class="mb-4">
            <label for="pergunta" class="form-label">Descreva seu problema:</label>
            <textarea class="form-control" id="pergunta" name="pergunta" rows="3" placeholder="Ex: Como cadastrar um novo aluno?" required></textarea>

            <button type="submit" class="btn btn-primary mt-2" id="btnEnviar">
                Buscar solução com IA
            </button>
        </form>

        <div id="feedback" style="display: none;">
            <div class="alert alert-info" role="alert">
                <span id="resposta-gerada">Buscando sugestão...</span>
            </div>
        </div>

        <div id="erro" style="display: none;">
            <div class="alert alert-danger" role="alert">
                <span id="erro-mensagem">Erro inesperado.</span>
            </div>
        </div>


    <div id="resposta-gerada" class="mt-3 alert alert-info" style="display: none;"></div>

    <div class="row">
        @foreach($tutoriais as $tutorial)
            <div class="col-md-6 mb-3">
                <a href="{{ route('ajuda.show', $tutorial) }}" class="card h-100 text-decoration-none text-dark">
                    <div class="card-body">
                        <h5 class="card-title">{{ $tutorial->titulo }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($tutorial->descricao, 100) }}</p>
                        @if ($tutorial->video_url)
                            <span class="badge bg-info text-dark">Vídeo</span>
                        @endif
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    {{ $tutoriais->links() }}
</div>
@endsection
