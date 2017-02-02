<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'sites';

    protected $fillable = [
        'title', 'keywords', 'describe','logo','ico','footer'
    ];
}
