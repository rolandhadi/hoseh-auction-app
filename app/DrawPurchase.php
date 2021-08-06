<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrawPurchase extends Model
{
    public function draw()
    {
        return $this->hasOne('App\DrawPlan', 'id', 'draw_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function winner()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
