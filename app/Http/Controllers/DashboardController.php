<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\About;
use App\DrawPlan;
use App\BidPlan;
use App\UserTestimonial;
use App\Http\Requests;
use App\Banner;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $out = array();
        $pdc = new ProductDetailController;

        $active_draws = DrawPlan::where('status', 1)
            ->whereDate('start', '<=', Carbon::today()->toDateString())
            ->orderBy('end')
            ->take(12)
            ->get();
        if ($active_draws) {
            if (count($active_draws) > 4) {
                $thumbsize = 'col-xs-6 col-sm-4 col-md-3';
            } else {
                $thumbsize = 'col-xs-12 col-sm-6 col-md-6';
            }
            foreach ($active_draws as $key => $draw) {
                $img = $pdc->get_product_image($draw->product()->first());
                $out['active_draws'][$key] = [
                    'id' => $draw->id,
                    'joined' => $draw->draws()->where('user_id', session('user_id'))->count(),
                    'product' => $draw->product()->first()->id,
                    'name' => $draw->product()->first()->name,
                    'thumbsize' => $thumbsize,
                    'price' => $draw->product()->first()->price,
                    'img' => $img
                ];
            }
        }

        $completed_draws = DrawPlan::whereIn('status', ['2', '3', '4'])
            ->orderBy('end', 'desc')
            ->take(20)
            ->get();

        if ($completed_draws) {
            foreach ($completed_draws as $key => $draw) {
                $img = $pdc->get_product_image($draw->product()->first());
                $winner = $draw->winner()->first();
                if ($winner) {
                    if ($winner->nick_name) {
                        $nick_name = $winner->nick_name;
                    } else {
                        $nick_name = $winner->first_name . $winner->last_name;
                    }
                } else {
                    $nick_name = 'No Winner';
                }
                $out['completed_draws'][$key] = [
                    'id' => $draw->id,
                    'product' => $draw->product()->first()->id,
                    'name' => $draw->product()->first()->name,
                    'price' => $draw->product()->first()->price,
                    'winner' => $nick_name,
                    'img' => $img
                ];
            }
        }
        $footer = About::all()->first();
        $details = [
            'about' => $footer->about
        ];
        $testimonials_out = array();
        $testimonials = UserTestimonial::orderBy('updated_at', 'desc')
            ->take(5)
            ->get();
        if ($testimonials) {
            $first_entry = true;
            $active = '';
            foreach ($testimonials as $key => $testimonial) {
                if ($first_entry) {
                  $first_entry = false;
                  $active = 'active';
                }
                else {
                  $active = '';
                }
                if ($testimonial->img) {
                    $img = asset('testimonial-imgs/' . $testimonial->img);
                } else {
                    $img = asset('img/' . 'no-image.png');
                }
                $testimonials_out['testimonials'][$key] = [
                    'name' => $testimonial->name,
                    'message' => $testimonial->message,
                    'active' => $active,
                    'image' => $img
                ];
            }
        }

        $banners = Banner::orderBy('banner_no')->get();
        foreach ($banners as $k => $banner) {
          $banner_out[$k] = $banner->url;
        }

        return view('layouts.dashboard', $out)->with('details', $details)
            ->with('testimonials', $testimonials_out)
            ->with('banners', $banner_out);
    }

    public function index_bid(Request $request)
    {
        $out = array();
        $pdc = new ProductDetailController;

        $active_bids = BidPlan::where('status', 1)
            ->whereDate('start', '<=', Carbon::today()->toDateString())
            ->orderBy('end')
            ->take(12)
            ->get();
        if ($active_bids) {
            if (count($active_bids) > 4) {
                $thumbsize = 'col-xs-6 col-sm-4 col-md-3';
            } else {
                $thumbsize = 'col-xs-12 col-sm-6 col-md-6';
            }
            foreach ($active_bids as $key => $bid) {
                $img = $pdc->get_product_image($bid->product()->first());
                $out['active_bids'][$key] = [
                    'id' => $bid->id,
                    'product' => $bid->product()->first()->id,
                    'bid_amount' => $bid->increment * $bid->entries,
                    'last_bidder' => BidUserController::last_bidder($bid->id),
                    'name' => $bid->product()->first()->name,
                    'thumbsize' => $thumbsize,
                    'img' => $img
                ];
            }
        }

        $completed_bids = BidPlan::whereIn('status', ['2', '3', '4'])
            ->orderBy('end', 'desc')
            ->take(20)
            ->get();

        if ($completed_bids) {
            foreach ($completed_bids as $key => $bid) {
                $img = $pdc->get_product_image($bid->product()->first());
                $winner = $bid->winner()->first();
                if ($winner) {
                    if ($winner->nick_name) {
                        $nick_name = $winner->nick_name;
                    } else {
                        $nick_name = $winner->first_name . $winner->last_name;
                    }

                    $product_price = $bid->product()->first()->price;
                    $bid_price = $bid->increment * $bid->entries;
                    $savings = $product_price - $bid_price;
                    $percent_savings = round(($savings / $product_price) * 100);
                } else {
                    $nick_name = 'No Winner';
                    $percent_savings = 0;
                }

                $out['completed_bids'][$key] = [
                    'id' => $bid->id,
                    'product' => $bid->product()->first()->id,
                    'name' => $bid->product()->first()->name,
                    'savings' => $percent_savings,
                    'winner' => $nick_name,
                    'bid_amount' => $bid->increment * $bid->entries,
                    'price' => $bid->product()->first()->price,
                    'img' => $img
                ];

            }
        }
        $footer = About::all()->first();
        $details = [
            'about' => $footer->about
        ];
        $testimonials_out = array();
        $testimonials = UserTestimonial::orderBy('updated_at', 'desc')
            ->take(5)
            ->get();
        if ($testimonials) {
            $first_entry = true;
            $active = '';
            foreach ($testimonials as $key => $testimonial) {
                if ($first_entry) {
                  $first_entry = false;
                  $active = 'active';
                }
                else {
                  $active = '';
                }
                if ($testimonial->img) {
                    $img = asset('testimonial-imgs/' . $testimonial->img);
                } else {
                    $img = asset('img/' . 'no-image.png');
                }
                $testimonials_out['testimonials'][$key] = [
                    'name' => $testimonial->name,
                    'message' => $testimonial->message,
                    'active' => $active,
                    'image' => $img
                ];
            }
        }

        $banners = Banner::orderBy('banner_no')->get();
        foreach ($banners as $k => $banner) {
          $banner_out[$k] = $banner->url;
        }

        return view('layouts.dashboard-bid', $out)->with('details', $details)
            ->with('testimonials', $testimonials_out)
            ->with('banners', $banner_out);
    }

    public function about()
    {
        $footer = About::all()->first();
        $details = [
            'about' => $footer->about,
        ];

        return view('layouts.about')->with('details', $details);
    }
}
