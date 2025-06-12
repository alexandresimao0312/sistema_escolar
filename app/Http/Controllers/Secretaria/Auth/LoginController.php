<?php

namespace App\Http\Controllers\Secretaria\Auth;


use App\Models\ActivityLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use App\Models\Secretaria;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    //

     use \Illuminate\Foundation\Auth\AuthenticatesUsers;

    protected $redirectTo = '/secretaria/dashboard'; // Rota padrão se não redirecionar manualmente

    public function __construct()
    {
        $this->middleware('guest:secretaria')->except('logout');
    }
     
     // Define qual guard usar
     
    protected function guard()
    {
        $this->logActivity('login', 'secretaria', Auth::guard('secretaria')->id());
        return Auth::guard('secretaria');
    }

     // Redirecionar após login bem-sucedido
  
    protected function authenticated(Request $request, $user)
    {
        if ($user instanceof Secretaria) {
            // Gera código 2FA e envia ( esse método foi criado no model secretaria)
        
            $user->generateTwoFactorCode(); 
            return redirect()->route('2fa.index'); // Redireciona para a verificação 2FA
           
        }
      
        return redirect()->intended($this->redirectTo);
    }

    public function showLoginForm()
    {
        return view('secretaria.auth.login');
    }
  
    public function logout()
    {
        $this->logActivity('logout', 'secretaria', Auth::guard('secretaria')->id());
         Cache::forget('user-is-online-' . Auth::id());
        Auth::guard('secretaria')->logout();
        return redirect()->route('secretaria.login');
    }

    protected function logActivity($event, $userType = null, $userId = null)
    {
        ActivityLog::create([
            'user_type' => $userType ?? 'unknown',
            'user_id' => $userId,
            'event' => $event,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

 
}
