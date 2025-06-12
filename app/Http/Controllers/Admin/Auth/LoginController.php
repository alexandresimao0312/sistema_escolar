<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\ActivityLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use App\Models\Admin;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{

      use \Illuminate\Foundation\Auth\AuthenticatesUsers;

    protected $redirectTo = '/admin/admin/dashboard'; // Rota padrão se não redirecionar manualmente

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
     
     // Define qual guard usar
     
    protected function guard()
    {
          $this->logActivity('login', 'admin', Auth::guard('admin')->id());
        return Auth::guard('admin');
        
    }

     // Redirecionar após login bem-sucedido
  
    protected function authenticated(Request $request, $user)
    {
        if ($user instanceof Admin) {
            // Gera código 2FA e envia ( esse método foi criado no model Admin)
            $user->generateTwoFactorCode(); 
            return redirect()->route('admin.2fa.index'); // Redireciona para a verificação 2FA
        }
      
        return redirect()->intended($this->redirectTo);
    }



    public function showLoginForm()
    {
        return view('escola.admin.admin.auth.login');
    }

    public function logout()
    {
        $this->logActivity('logout', 'admin', Auth::guard('admin')->id());
        Cache::forget('user-is-online-' . Auth::id());
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.form');
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
