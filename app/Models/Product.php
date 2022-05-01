<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $guarded = [];

    protected $casts = ['created_at' => 'datetime:Y-m-d H:m:s', 'updated_at' => 'datetime:Y-m-d H:m:s'];

    public function files()
    {
        return $this->hasMany(File::class, 'relation_id', 'id')->where('file_type', 'product');
    }

    public function others_data()
    {
        return $this->hasMany(ProductOtherData::class, 'product_id', 'id');
    }

    public function malls()
    {
        return $this->hasMany(MallProduct::class, 'product_id', 'id');
    }
}
