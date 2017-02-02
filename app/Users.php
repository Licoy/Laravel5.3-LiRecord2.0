<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';

    public $primaryKey = 'user_id';

    protected $fillable = [
        'user_name', 'user_password', 'user_email','user_gender','user_qq','remember_token','user_gag'
    ];
}
