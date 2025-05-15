<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('escola.admin.admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

       

        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->filled('remember'))) {

            // Limpa sessões antigas
            $admin = Auth::guard('admin')->user();
            if ($admin->session_id && $admin->session_id !== Session::getId()) {
                Session::getHandler()->destroy($admin->session_id);
            }

            // Armazena nova sessão
            $admin->session_id = Session::getId();
            $admin->save();
            return redirect()->route('admin.admin.dashboard');
        }

        return back()->withErrors(['email' => 'Credenciais inválidas']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.form');
    }
}
