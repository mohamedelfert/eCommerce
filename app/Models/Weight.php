<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    protected $table = 'weights';

    protected $guarded = [];

    protected $casts = ['created_at' => 'datetime:Y-m-d H:m:s', 'updated_at' => 'datetime:Y-m-d H:m:s'];
}
