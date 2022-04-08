<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';

    protected $guarded = [];

    protected $casts = ['created_at' => 'datetime:Y-m-d H:m:s', 'updated_at' => 'datetime:Y-m-d H:m:s'];

    public function department_id()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
}
