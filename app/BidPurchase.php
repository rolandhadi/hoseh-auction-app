<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidPurchase extends Model
{
    public function bid()
    {
        return $this->hasOne('App\BidPlan', 'id', 'bid_id');
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
