<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function tags()
    {
        return $this->hasMany('App\ProductTag', 'product_id');
    }

    public function imgs()
    {
        return $this->hasMany('App\ProductImage', 'product_id');
    }
}
