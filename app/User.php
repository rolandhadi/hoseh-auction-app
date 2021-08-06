<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'nick_name',
        'email',
        'mobile',
        'gender',
        'birthday',
        'password',
        'tokens',
        'send_promo',
        'verification_code'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function pending_payments()
    {
        $draw_count = $this->hasMany('App\DrawPlan', 'winner_id')->where('status', '2')->count();
        $bid_count = $this->hasMany('App\BidPlan', 'winner_id')->where('status', '2')->count();
        $draw_purchases_count = $this->hasMany('App\DrawPurchase', 'user_id')->where('status', '2')->count();
        $bid_purchases_count = $this->hasMany('App\BidPurchase', 'user_id')->where('status', '2')->count();
        $total = $draw_count + $bid_count + $draw_purchases_count + $bid_purchases_count;
        if ($total) {
            $out = '<span class="badge">' . $total . '</span>';
        } else {
            $out = '';
        }

        return $out;
    }

    public function pending_payment()
    {
        $draw_count = $this->hasMany('App\DrawPlan', 'winner_id')->where('status', '2')->count();
        $bid_count = $this->hasMany('App\BidPlan', 'winner_id')->where('status', '2')->count();
        $draw_purchases_count = $this->hasMany('App\DrawPurchase', 'user_id')->where('status', '2')->count();
        $bid_purchases_count = $this->hasMany('App\BidPurchase', 'user_id')->where('status', '2')->count();
        $total = $draw_count + $bid_count + $draw_purchases_count + $bid_purchases_count;
        if ($total) {
            $out = '<span class="badge">' . $total . '</span>';
        } else {
            $out = '';
        }

        return $out;
    }

    public function draw_pending_payment()
    {
        $draw_count = $this->hasMany('App\DrawPlan', 'winner_id')->where('status', '2')->count();
        if ($draw_count) {
            $out = '<span class="badge">' . $draw_count . '</span>';
        } else {
            $out = '';
        }

        return $out;
    }

    public function bid_pending_payment()
    {
        $bid_count = $this->hasMany('App\BidPlan', 'winner_id')->where('status', '2')->count();
        if ($bid_count) {
            $out = '<span class="badge">' . $bid_count . '</span>';
        } else {
            $out = '';
        }

        return $out;
    }

    public function draw_purchase_pending_payment()
    {
        $draw_purchases_count = $this->hasMany('App\DrawPurchase', 'user_id')->where('status', '2')->count();
        if ($draw_purchases_count) {
            $out = '<span class="badge">' . $draw_purchases_count . '</span>';
        } else {
            $out = '';
        }

        return $out;
    }

    public function bid_purchase_pending_payment()
    {
        $bid_purchases_count = $this->hasMany('App\BidPurchase', 'user_id')->where('status', '2')->count();
        if ($bid_purchases_count) {
            $out = '<span class="badge">' . $bid_purchases_count . '</span>';
        } else {
            $out = '';
        }

        return $out;
    }

}
