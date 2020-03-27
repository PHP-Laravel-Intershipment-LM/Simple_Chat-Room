<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ChatModel extends Model
{
    public $table = 'chats';

    public $fillable = ['id', 'id_active', 'message', 'time'];

    public $timestamp = false;
}
