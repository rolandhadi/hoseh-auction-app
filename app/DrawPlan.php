<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrawPlan extends Model
{
    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'product_id');
    }

    public function winner()
    {
        return $this->hasOne('App\User', 'id', 'winner_id');
    }

    public function draws()
    {
        return $this->hasMany('App\DrawUser', 'draw_id');
    }

    public function return_tokens($user_id)
    {
        $draw = $this->hasMany('App\DrawUser', 'draw_id');

        return $draw->where('user_id', $user_id);
    }

    public function purchases()
    {
        return $this->hasMany('App\DrawPurchase', 'draw_id');
    }
}
