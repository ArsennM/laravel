<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Message;


class Notification extends Model
{


    const TYPE_FOLLOW = 'follow';
    const TYPE_LIKE = 'like';


    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function message()
    {
        return $this->belongsTo(Message::class, 'message_id');
    }

    public function getTypeAttribute()
    {
        if ($this->message_id === Notification::TYPE_FOLLOW) {
            return self::TYPE_FOLLOW;
        } elseif ($this->message_id === Notification::TYPE_LIKE) {
            return self::TYPE_LIKE;
        }
        return null;
    }
}
