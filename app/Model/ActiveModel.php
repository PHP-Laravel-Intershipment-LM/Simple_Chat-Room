<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ActiveModel extends Model
{
    protected $table = 'actives';

    protected $fillable = ['id', 'id_room', 'id_user', 'created_at', 'updated_at'];
}
