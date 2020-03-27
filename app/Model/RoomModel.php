<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoomModel extends Model
{
    public $table = 'rooms';

    public $fillable = ['id', 'name'];

    public $timestamp = false;
}
