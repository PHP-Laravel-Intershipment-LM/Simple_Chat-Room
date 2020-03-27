<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoomModel extends Model
{
    protected $table = 'rooms';

    protected $fillable = ['id', 'name', 'created_at', 'updated_at'];
}
