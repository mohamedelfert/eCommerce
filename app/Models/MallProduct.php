<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MallProduct extends Model
{
    protected $table = 'mall_products';

    protected $guarded = [];

    protected $casts = ['created_at' => 'datetime:Y-m-d H:m:s', 'updated_at' => 'datetime:Y-m-d H:m:s'];

    public function mall()
    {
        return $this->hasOne(Mall::class, 'mall_id', 'id');
    }
}
