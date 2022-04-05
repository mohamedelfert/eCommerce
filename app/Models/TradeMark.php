<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TradeMark extends Model
{
    protected $table = 'trade_marks';

    protected $guarded = [];

    protected $casts = ['created_at' => 'datetime:Y-m-d H:m:s', 'updated_at' => 'datetime:Y-m-d H:m:s'];
}
