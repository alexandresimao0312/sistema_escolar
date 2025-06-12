<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;

class ConversationsComposer
{
    public function compose(View $view)
    {
          $user = $this->getAuthenticatedUser();

    if (!$user) {
        abort(403, 'Usuário não autenticado.');
    }


        $conversations = Conversation::where(function ($query) use ($user) {
            $query->where('user_one_type', get_class($user))
                ->where('user_one_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('user_two_type', get_class($user))
                ->where('user_two_type', $user->id);
        })->latest()->get();


        $view->with('conversations', $conversations);
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
