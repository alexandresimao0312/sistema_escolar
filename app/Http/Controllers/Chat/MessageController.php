<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use App\Events\NovaMensagemEnviada;
use App\Events\MessageSent;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $conversationId)
    {
        //
         $request->validate([
            'body' => 'required|string',
        ]);

         // Recuperar o usuário autenticado com múltiplos guards
        $authUser = auth('secretaria')->user() ??
                auth('admin')->user() ;

        $conversation = Conversation::findOrFail($conversationId);
        // $this->authorize('sendMessage', $conversation);

        // Validação de permissão (evita que outro usuário envie em conversas alheias)
        
        $user = $this->getAuthenticatedUser();
        if (
            ($conversation->user_one_type !== get_class($user) || $conversation->user_one_id !== $user->id) &&
            ($conversation->user_two_type !== get_class($user) || $conversation->user_two_id !== $user->id)
        ) {
            abort(403, 'Acesso negado à conversa.');
        }

        $message = Message::create([
            'conversation_id' => $conversation->id,
             'sender_id' => $authUser->id,
             'sender_type' => get_class($authUser),
            'body' => $request->body,
        ]);

        event(new NovaMensagemEnviada($message));

        return redirect()->route('chat.conversations.show', $conversationId)->with('success', 'Mensagem enviada com sucesso.');
    }
      public function storeAdmin(Request $request, $conversationId)
    {
        //
         $request->validate([
            'body' => 'required|string',
        ]);

         // Recuperar o usuário autenticado com múltiplos guards
        $authUser = auth('secretaria')->user() ??
                auth('admin')->user() ;

        $conversation = Conversation::findOrFail($conversationId);
        // $this->authorize('sendMessage', $conversation);

        // Validação de permissão (evita que outro usuário envie em conversas alheias)
        
       
        $message = Message::create([
            'conversation_id' => $conversation->id,
             'sender_id' => $authUser->id,
             'sender_type' => get_class($authUser),
            'body' => $request->body,
        ]);

       event(new MessageSent($message));

        return redirect()->route('admin.chat.conversations.show', $conversationId)->with('success', 'Mensagem enviada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

        public function edit(Message $message)
    {
        $this->authorize('update', $message); // optional: usar policy
        return view('chat.messages.edit', compact('message'));
    }

    public function update(Request $request, Message $message)
    {
        $this->authorize('update', $message);

        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $message->body = $request->body;
        $message->save();

        return redirect()->route('admin.chat.conversations.show', $message->conversation_id)
                         ->with('success', 'Mensagem atualizada com sucesso!');
    }

    public function destroy(Message $message)
    {
        $this->authorize('delete', $message);

        $conversationId = $message->conversation_id;
        $message->delete();

        return redirect()->route('admin.chat.conversations.show', $conversationId)
                         ->with('success', 'Mensagem excluída com sucesso!');
    

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
}
