<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidUser extends Model
{
    public function bid()
    {
        return $this->hasOne('App\BidPlan', 'id', 'bid_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function participants()
    {
        return $this->hasMany('App\User', 'user_id');
    }
}
