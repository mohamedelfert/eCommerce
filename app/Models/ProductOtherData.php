<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOtherData extends Model
{
    protected $table = 'product_other_data';

    protected $guarded = [];

    protected $casts = ['created_at' => 'datetime:Y-m-d H:m:s', 'updated_at' => 'datetime:Y-m-d H:m:s'];
}
