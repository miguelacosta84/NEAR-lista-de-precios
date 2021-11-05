<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyList extends Model
{
    public $table = 'my_list';

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'id'              => 'integer',
        'name'            => 'string'
    ];

}
