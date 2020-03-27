<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users';

    protected $fillable = ['id', 'username', 'password', 'isOnline', 'created_at', 'updated_at'];
}
