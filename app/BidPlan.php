<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidPlan extends Model
{
    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'product_id');
    }

    public function winner()
    {
        return $this->hasOne('App\User', 'id', 'winner_id');
    }

    public function bids()
    {
        return $this->hasMany('App\BidUser', 'bid_id');
    }

    public function return_tokens($user_id)
    {
        $bid = $this->hasMany('App\BidUser', 'bid_id');

        return $bid->where('user_id', $user_id);
    }

    public function purchases()
    {
        return $this->hasMany('App\BidPurchase', 'bid_id');
    }
}
