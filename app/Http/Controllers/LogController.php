<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\LogAtividade;

class LogController extends Controller
{
    public function index()
    {
        $logs = LogAtividade::where('secretaria_id', Auth::guard('secretaria')->id())
                    ->latest()
                    ->paginate(15);

        return view('escola.admin.secretaria.logs.index', compact('logs'));
    }
}

