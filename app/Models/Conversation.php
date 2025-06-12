<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    //
        protected $fillable = [
        'user_one_id', 'user_one_type',
        'user_two_id', 'user_two_type',
    ];

    public function userOne()
    {
        return $this->morphTo('user_one');
    }

    public function userTwo()
    {
        return $this->morphTo('user_two');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function sender()
    {
        return $this->morphTo('sender', 'user_one_type', 'user_one_id');
    }

    public function receiver()
    {
        return $this->morphTo('receiver', 'user_two_type', 'user_two_id');
    }

    // Verifica se um dado usuário faz parte da conversa
    public function involves($user)
    {
        return (
            ($this->user_one_id == $user->id && $this->user_one_type == get_class($user)) ||
            ($this->user_two_id == $user->id && $this->user_two_type == get_class($user))
        );
    }
}
