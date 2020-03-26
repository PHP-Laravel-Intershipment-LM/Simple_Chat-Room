<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ActiveModel extends Model
{
    public $table = 'actives';

    public $fillable = ['id', 'id_room', 'id_user'];
}
