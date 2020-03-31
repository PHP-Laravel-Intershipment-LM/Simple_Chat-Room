<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ChatModel extends Model
{
    protected $table = 'chats';

    protected $fillable = ['id', 'id_active', 'message', 'created_at', 'updated_at'];
}
