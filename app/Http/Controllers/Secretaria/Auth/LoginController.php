<?php

namespace App\Http\Controllers\Secretaria\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('secretaria.auth.login');
    }
    public function login(Request $request)
    {

          $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        $estado = 'ativo';

        if (Auth::guard('secretaria')->attempt(['email' => $request->email, 'password' => $request->password, 'ativo' => 1])) {
            // Limpa sessões antigas
            $secretaria = Auth::guard('secretaria')->user();
            if ($secretaria->session_id && $secretaria->session_id !== Session::getId()) {
                Session::getHandler()->destroy($secretaria->session_id);
            }

            // Armazena nova sessão
            $secretaria->session_id = Session::getId();
            $secretaria->save();
            return redirect()->intended('/secretaria/dashboard');
        }


        return back()->withErrors('Credenciais invalidas ou Conta Desativada');
    }
    
    public function logout()
    {
        Auth::guard('secretaria')->logout();
        return redirect()->route('secretaria.login');
    }
}
