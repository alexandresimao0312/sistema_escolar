<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Central de Ajuda')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- Google Fonts + Estilo leve e moderno --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    {{-- Ícones --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .header {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
        }
        .header h1 {
            font-weight: 600;
            font-size: 1.5rem;
        }
        .search-bar {
            max-width: 600px;
        }
        .footer {
            background-color: #fff;
            border-top: 1px solid #dee2e6;
            padding: 1rem 0;
            text-align: center;
            font-size: 0.9rem;
            color: #6c757d;
        }
        .card:hover {
            box-shadow: 0 0 12px rgba(0,0,0,0.06);
            transition: all 0.2s ease-in-out;
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Cabeçalho --}}
    <header class="header py-3 mb-4 shadow-sm">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="mb-0">
                <a href="{{ route('ajuda.index') }}" class="text-decoration-none text-dark">
                    <i class="bi bi-question-circle-fill me-2"></i> Central de Ajuda
                </a>
            </h1>
        </div>
    </header>

    {{-- Conteúdo --}}
    <main>
        @yield('conteudo')
    </main>

    {{-- Rodapé --}}
    <footer class="footer mt-5">
        <div class="container">
            &copy; {{ date('Y') }} <a href="http://" style="text-decoration: none">Alexandre Sales Simão</a>. Todos os direitos reservados.
        </div>
    </footer>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

    
 <!-- Script de integração de IA / chatgpt-->
<script>
    document.getElementById('form-ajuda').addEventListener('submit', function(e) {
        e.preventDefault();

        const pergunta = document.getElementById('pergunta').value;
        const feedback = document.getElementById('feedback');
        const erro = document.getElementById('erro');
        const respostaTexto = document.getElementById('resposta-gerada');
        const erroTexto = document.getElementById('erro-mensagem');

        // Reset estados visuais
        feedback.style.display = 'block';
        erro.style.display = 'none';
        respostaTexto.innerText = 'Buscando sugestão...';

        fetch('/ajuda/sugestao', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ pergunta: pergunta })
        })
        .then(response => response.json())
        .then(data => {
            if (data.resposta) {
                respostaTexto.innerText = data.resposta;
            } else {
                feedback.style.display = 'none';
                erro.style.display = 'block';
                erroTexto.innerText = data.erro || 'Erro desconhecido.';
            }
        })
        .catch(error => {
            feedback.style.display = 'none';
            erro.style.display = 'block';
            erroTexto.innerText = 'Erro de rede ou servidor: ' + error.message;
        });
    });
</script>

</body>
</html>
