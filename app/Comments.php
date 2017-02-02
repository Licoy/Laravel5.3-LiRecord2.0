<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';

    public $primaryKey = 'id';

    protected $fillable = [
        'user', 'text', 'user','parent','support','ip','agent'
    ];
}
