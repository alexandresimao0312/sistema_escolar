<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    //
    public function index()
    {
        return view('escola.admin.verificacaoAuth.index');
    }


    public function verify(Request $request)
{
    $request->validate([
        '2fa_code' => 'required|digits:6',
    ]);

    $user = Auth::guard('secretaria')->user();

    if (!$user) {
        return redirect()->route('secretaria.login');
    }

     if (!$user->two_factor_code || $user->two_factor_expires_at->isPast()) {
            auth()->logout();
            return redirect()->route('secretaria.login')->withErrors(['expired' => 'Código expirado. Faça login novamente.']);
        }


    if ($request->input('2fa_code') === $user->two_factor_code) {
        // Limpa o código e redireciona para o dashboard
        $user->resetTwoFactorCode();
        return redirect()->route('secretaria.dashboard');
    }

    return back()->withErrors(['2fa_code' => 'O código informado está incorreto.']);
}

}
