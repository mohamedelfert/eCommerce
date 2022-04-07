<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ShippingCompany extends Model
{
    protected $table = 'shipping_companies';

    protected $guarded = [];

    protected $casts = ['created_at' => 'datetime:Y-m-d H:m:s', 'updated_at' => 'datetime:Y-m-d H:m:s'];

    public function user_id()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
