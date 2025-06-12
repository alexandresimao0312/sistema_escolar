<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Message extends Model
{
    //
      protected $fillable = [
        'conversation_id',
        'sender_id',
        'sender_type',
        'body',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * Conversa à qual esta mensagem pertence.
     */
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    /**
     * Usuário que enviou a mensagem (morph: Admin, Secretaria, Professor...).
     */
    public function sender(): MorphTo
    {
        return $this->morphTo();
    }
}
