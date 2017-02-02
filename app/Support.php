<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $table = 'supports';

    public $primaryKey = 'id';

    protected $fillable = [
        'user_id', 'comment_id'
    ];
}
