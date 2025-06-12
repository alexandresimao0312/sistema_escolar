<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorAdminController extends Controller
{
    //
    public function index()
    {
        return view('escola.admin.verificacaoAuth.indexAdmin');
    }


    public function verify(Request $request)
{
    $request->validate([
        '2fa_code' => 'required|digits:6',
    ]);

    $user = Auth::guard('admin')->user();

    if (!$user) {
        return redirect()->route('admin.login');
    }

     if (!$user->two_factor_code || $user->two_factor_expires_at->isPast()) {
            auth()->logout();
            return redirect()->route('admin.login')->withErrors(['expired' => 'Código expirado. Faça login novamente.']);
        }


    if ($request->input('2fa_code') === $user->two_factor_code) {
        // Limpa o código e redireciona para o dashboard
        $user->resetTwoFactorCode();
        return redirect()->route('admin.admin.dashboard');
    }

    return back()->withErrors(['2fa_code' => 'O código informado está incorreto.']);
}

}
