<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificacaoPaginaController extends Controller
{
    //
    public function index()
    {
        $secretaria = Auth::guard('secretaria')->user();

        // Supondo que as notificações estão relacionadas à secretaria
        $notificacoes = $secretaria->notifications()->latest()->paginate(50);

        return view('escola.admin.secretaria.notification.index', compact('notificacoes'));
    }
}
