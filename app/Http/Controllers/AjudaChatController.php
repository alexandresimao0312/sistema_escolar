<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AjudaSugestao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AjudaChatController extends Controller
{
    //

     public function gerarSugestao(Request $request)
    {
     $prompt = $request->input('pergunta');

    if (empty($prompt)) {
        return response()->json(['erro' => 'Pergunta não fornecida.']);
    }

    try {
        $response = Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'Você é um assistente de suporte para um sistema de gestão escolar. Forneça respostas curtas e práticas.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        if ($response->failed()) {
            return response()->json([
                'erro' => 'Falha na comunicação com o ChatGPT.',
                'detalhes' => $response->json(),
            ]);
        }

        $resposta = $response->json()['choices'][0]['message']['content'] ?? 'Não foi possível gerar uma resposta.';

        return response()->json(['resposta' => $resposta]);

    } catch (\Exception $e) {
        return response()->json([
            'erro' => 'Erro inesperado.',
            'detalhes' => $e->getMessage(),
        ]);

}
    $user = $this->getAuthenticatedUser();

    if (!$user) {
        abort(403, 'Usuário não autenticado.');
    }
        
    // Salvar no banco
    AjudaSugestao::create([
        'pergunta' => $prompt,
        'resposta' => $resposta,
        'ip' => $request->ip(),
        'user_type' => get_class($user),
        'user_id' => $user->id,
    ]);

    return response()->json(['resposta' => $resposta]);
    }

        function getAuthenticatedUser()
    {
        foreach (['secretaria', 'admin'] as $guard) {
            if (Auth::guard($guard)->check()) {
                return Auth::guard($guard)->user();
            }
        }

        return null;
    }
}
