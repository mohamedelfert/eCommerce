<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    protected $guarded = [];

    protected $casts = ['created_at' => 'datetime:Y-m-d H:m:s','updated_at' => 'datetime:Y-m-d H:m:s'];

    public function city_id()
    {
        return $this->hasOne(City::class ,'id','city_id');
    }

    public function country_id()
    {
        return $this->hasOne(Country::class ,'id','country_id');
    }
}
