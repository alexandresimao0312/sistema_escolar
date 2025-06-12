<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Secretaria;
use App\Models\Admin;
use App\Models\Professor;
use Illuminate\Support\Facades\Auth;
use App\Events\NovaMensagemEnviada;

class ConversationController extends Controller
{

    public function index()
    {

    $user = $this->getAuthenticatedUser();

    if (!$user) {
        abort(403, 'Usuário não autenticado.');
    }

        $userClass = get_class($user);

        $conversations = Conversation::with(['sender', 'receiver'])
    ->where(function ($query) use ($user, $userClass) {
        $query->where('user_one_type', $userClass)
              ->where('user_one_id', $user->id);
    })->orWhere(function ($query) use ($user, $userClass) {
        $query->where('user_two_type', $userClass)
              ->where('user_two_id', $user->id);
    })->latest()->get();

        return view('chat.conversations.index', compact('conversations'));
        
    
    }
        public function indexAdmin()
    {

    $user = $this->getAuthenticatedUser();

    if (!$user) {
        abort(403, 'Usuário não autenticado.');
    }

        $userClass = get_class($user);

        $conversations = Conversation::with(['sender', 'receiver'])
    ->where(function ($query) use ($user, $userClass) {
        $query->where('user_one_type', $userClass)
              ->where('user_one_id', $user->id);
    })->orWhere(function ($query) use ($user, $userClass) {
        $query->where('user_two_type', $userClass)
              ->where('user_two_id', $user->id);
    })->latest()->get();

        return view('chat.conversations.AdminIndex', compact('conversations'));
        
    
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


public function create()
{
    // Buscar todos os usuários disponíveis (de todos os guards)
    $secretarias = Secretaria::all();
    $admins = Admin::all();
    $professores = Professor::all();

    return view('chat.conversations.create', compact('secretarias', 'admins', 'professores'));
}

public function store(Request $request)
{
    $request->validate([
        'user_two_type' => 'required|string',
        'user_two_id' => 'required|integer',
        'body' => 'required|string',
    ]);

    
   $sender = $this->getAuthenticatedUser();

    if (!$sender) {
        abort(403, 'Usuário não autenticado.');
    }

     
    $conversation = Conversation::firstOrCreate([
        'user_one_type' => get_class($sender),
        'user_one_id' => $sender->id,
        'user_two_type' => $request->user_two_type,
        'user_two_id' => $request->user_two_id,
    ], [
         'user_one_type' => get_class($sender),
        'user_one_id' => $sender->id,
        'user_two_type' => $request->user_two_type,
        'user_two_id' => $request->user_two_id,
    ]);

    $conversation->messages()->create([
        'sender_type' => get_class($sender),
        'sender_id' => $sender->id,
        'body' => $request->body,
        
    ]);

   // event(new NovaMensagemEnviada($message));


    return redirect()->route('chat.conversations.show', $conversation->id);
}
public function createAdmin()
{
    // Buscar todos os usuários disponíveis (de todos os guards)
    $secretarias = Secretaria::all();
    $admins = Admin::all();
    $professores = Professor::all();

    return view('chat.conversations.adminCreate', compact('secretarias', 'admins', 'professores'));
}

public function storeAdmin(Request $request)
{
    $request->validate([
        'user_two_type' => 'required|string',
        'user_two_id' => 'required|integer',
        'body' => 'required|string',
    ]);

    
   $sender = $this->getAuthenticatedUser();

    if (!$sender) {
        abort(403, 'Usuário não autenticado.');
    }

     
    $conversation = Conversation::firstOrCreate([
        'user_one_type' => get_class($sender),
        'user_one_id' => $sender->id,
        'user_two_type' => $request->user_two_type,
        'user_two_id' => $request->user_two_id,
    ], [
         'user_one_type' => get_class($sender),
        'user_one_id' => $sender->id,
        'user_two_type' => $request->user_two_type,
        'user_two_id' => $request->user_two_id,
    ]);

    $conversation->messages()->create([
        'sender_type' => get_class($sender),
        'sender_id' => $sender->id,
        'body' => $request->body,
        
    ]);

   // event(new NovaMensagemEnviada($message));


    return redirect()->route('admin.chat.conversations.show', $conversation->id);
}

public function buscarUsuarios(Request $request)
{
    $tipo = $request->input('tipo');

    if (!$tipo) {
        return response()->json([]);
    }

    $model = null;

    switch ($tipo) {
        case 'App\\Models\\Secretaria':
            $model = Secretaria::select('id', 'nome')->get();
            break;
        case 'App\\Models\\Admin':
            $model = Admin::select('id', 'nome')->get();
            break;
        case 'App\\Models\\Professor':
            $model = Professor::select('id', 'nome')->get();
            break;
    }

    return response()->json($model);
}
public function show(Conversation $conversation)
    {
        $conversation = Conversation::with('messages')->findOrFail($conversation->id);

      // $this->authorize('view', $conversation); // Opcional: policy para segurança

        return view('chat.conversations.show', compact('conversation'));
    }

    public function showAdmin(Conversation $conversation)
    {
        $conversation = Conversation::with('messages')->findOrFail($conversation->id);

      // $this->authorize('view', $conversation); // Opcional: policy para segurança

        return view('chat.conversations.adminShow', compact('conversation'));
    }

}