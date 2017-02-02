<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $table = 'notices';

    public $primaryKey = 'id';

    protected $fillable = [
        'title', 'text'
    ];
}
