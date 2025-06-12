<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    //
     protected $fillable = [
        'user_type', 'user_id', 'event', 'ip_address', 'user_agent',
    ];
}
