<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';

    protected $guard = 'admin';

    protected $fillable = ['nome', 'email', 'password', 'foto'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
    'two_factor_expires_at' => 'datetime',
];

public function isOnline()
{
    return Cache::has('user-is-online-' . $this->id);
}

    public function generateTwoFactorCode()
    {
        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(5);
        $this->save();

        // Aqui você pode usar Notification, Mail ou Log
        // Mail::to($this->email)->send(new TwoFactorCodeMail($this));
        // Envia e-mail

      //  $this->notify(new \App\Notifications\TwoFactorCodeNotification());
    }

    public function resetTwoFactorCode()
{
    $this->two_factor_code = null;
    $this->two_factor_expires_at = null;
    $this->save();
}

}
