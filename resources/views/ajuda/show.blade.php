@extends('layouts.ajuda')

@section('title', $tutorial->titulo)

@section('conteudo')
<div class="container py-5">
    <a href="{{ route('ajuda.index') }}" class="btn btn-link">&larr; Voltar à Central de Ajuda</a>

    <h2>{{ $tutorial->titulo }}</h2>

    @if ($tutorial->video_url)
        <div class="my-4 ratio ratio-16x9">
            <iframe src="{{ $tutorial->video_url }}" frameborder="0" allowfullscreen></iframe>
        </div>
    @endif

    <div class="mt-3">
        {!! nl2br(e($tutorial->conteudo)) !!}
    </div>
</div>
@endsection
