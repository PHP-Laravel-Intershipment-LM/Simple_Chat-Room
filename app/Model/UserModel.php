<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    public $table = 'users';

    public $fillable = ['id', 'username', 'password', 'isOnline'];

    public $timestamps = false;
}
