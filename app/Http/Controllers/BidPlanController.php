<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Product;
use App\BidPlan;
use App\BidUser;
use Carbon\Carbon;
use App\ProductTag;
use App\Http\Requests;
use App\Jobs\SendEmail;
use App\Http\Controllers\ProductDetailController;

class BidPlanController extends Controller
{
    public function index(Request $request)
    {
        $out = array();
        $out['search'] = $request->p;
        $pdc = new ProductDetailController;

        $products_1 = Product::where('name', 'like', '%' . $request->p . '%')
            ->where('enabled', '=', 1)
            ->take(50)
            ->get();
        foreach ($products_1 as $key => $product) {
            $img = $pdc->get_product_image($product);
            $out['products'][$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'quantity' => $product->quantity,
                'img' => $img
            ];
        }

        $products_2 = ProductTag::where('tag', 'like', '%' . $request->p . '%')
            ->take(50)
            ->get();
        foreach ($products_2 as $key => $product) {
            if ($product->product()->first()->enabled == 1) {
                $img = $pdc->get_product_image($product->product()->first());
                $out['products'][$product->product()->first()->id] = [
                    'id' => $product->product()->first()->id,
                    'name' => $product->product()->first()->name,
                    'quantity' => $product->product()->first()->quantity,
                    'img' => $img
                ];
            }
        }

        $active_bids = BidPlan::where('status', 1)
            ->orderBy('end')
            ->paginate(20);
        $out['bid_links'] = $active_bids->links();
        if ($active_bids) {
            foreach ($active_bids as $key => $bid) {
                $img = $pdc->get_product_image($bid->product()->first());
                $out['active_bids'][$key] = [
                    'id' => $bid->id,
                    'product' => $bid->product()->first()->id,
                    'name' => $bid->product()->first()->name,
                    'bid_amount' => $bid->entries * $bid->increment,
                    'last_bidder' => BidUserController::last_bidder($bid->id),
                    'img' => $img
                ];
            }
        }

        return view('layouts.bid_management', $out);
    }

    public function create_product_from_template($p)
    {
        return '
                <div class="col-sm-12">
                  <div class="thumbnail completed-bids">
                    <div class="pull-right">
                     <a href="#" class="btn-fav"><span class="glyphicon glyphicon-heart"></span></a>
                   </div>
                    <a href="#">
                      <img src="' . asset($p["img"]) . '" alt="" />
                    </a>
                    <div class="caption">
                      <div class="bid-title">' . $p["name"] . '</div>
                      <div class="bid-caption">
                        <div class="pull-left bid-amt"> S$ 0.01 </div>
                        <div class="pull-right bid-user"> ****dana </div>
                      </div>
                    </div> <!-- <div class="caption"> -->
                  </div> <!-- <div class="thumbnail"> -->
                </div> <!-- <div class="col-sm-12"> -->
            ';
    }

    public function save_bid(Request $request)
    {
        if ($request->a == 'add') {
            $d = new BidPlan;
        } else {
            $d = BidPlan::where('id', '=', $request->b)->first();
        }

        $d->product_id = $request->p;
        $d->start = $request->s;
        $d->end = $request->e;
        $d->increment = $request->i;
        $d->status = 1;

        if ($d->save()) {
            return [1, $d->product()->first()->name . ' is saved successfully to the active bids', '/b/m'];
        } else {
            return [0, 'Cannot save the product to active bid'];
        }
    }

    public function delete_bid(Request $request)
    {
        $d = BidPlan::where('id', '=', $request->b)
            ->where('status', 1)
            ->first();
        if ($d) {
            $d->status = 9;
            if ($d->save()) {
                $bid_users = $d->bids()->get();
                if ($bid_users) {
                    foreach ($bid_users as $bid_user) {
                        $user = User::where('id', $bid_user->user_id)->first();
                        if ($user) {
                            $user->tokens += 1;
                            $user->save();
                        }
                    }
                }

                return [1, $d->product()->first()->name . ' is deleted successfully from the auction', '/b/m'];
            } else {
                return [0, 'Cannot delete the product from auction'];
            }
        } else {
            return [0, 'Cannot delete the product from auction'];
        }
    }

    public function show_bid(Request $request)
    {
        $out = '';
        $tags = '';
        $ids = '';
        $imgs = '';
        $action = '';
        $pdc = new ProductDetailController;
        if ($request->b) {
            $d = BidPlan::where('id', '=', $request->b)->first();
            $d_id = $d->id;
            $d_start = $d->start;
            $d_end = $d->end;
            $d_increment = $d->increment;
            $p = Product::where('id', '=', $d->product_id)->first();
        } else {
            $d_id = 0;
            $d_start = Carbon::now()->addMinutes(10);
            $d_end = Carbon::now()->addMinutes(60);
            $d_increment = 0.01;
            $p = Product::where('id', '=', $request->p)->first();
        }
        if ($p) {
            if ($request->m == 'p') {
                $m['url'] = '/p/m';
                $m['text'] = 'Product Management';
            } elseif ($request->m == 'd') {
                $m['url'] = '/d/m';
                $m['text'] = 'Auction Management';
            } elseif ($request->m == 'b') {
                $m['url'] = '/b/m';
                $m['text'] = 'Auction Management';
            } else {
                $m['url'] = '/';
                $m['text'] = 'Home';
            }
            if ($request->a == '1') {
                $action = 'add';
            } else {
                $action = 'update';
            }
            $out = [
                'p_url' => $m['url'],
                'p_m' => $request->m,
                'p_parent' => $m['text'],
                'd_id' => $d_id,
                'p_id' => $p->id,
                'p_name' => $p->name,
                'p_desc' => $p->desc,
                'p_quantity' => $p->quantity,
                'p_price' => $p->price,
                'p_start' => $d_start,
                'd_increment' => $d_increment,
                'p_end' => $d_end
            ];
            $tags = $pdc->get_tags($p->id);
            $ids = $pdc->get_images($p->id);
            if ($ids) {
                $ids = $ids->pluck('id');
            }
            $imgs = $pdc->get_images($p->id);
            if ($imgs) {
                $imgs = $imgs->pluck('img');
            }
        }

        return view('layouts.bid_product_bid', $out)
            ->with('tags', $tags)
            ->with('ids', $ids)
            ->with('imgs', $imgs)
            ->with('action', $action);
    }

    public function show_products(Request $request)
    {
        if ($request->p) {
            $out = array();
            $pdc = new ProductDetailController;
            $products_1 = Product::where('name', 'like', '%' . $request->p . '%')
                ->where('enabled', '=', 1)
                ->get();
            foreach ($products_1 as $key => $product) {
                $img = $pdc->get_product_image($product);
                $out['products'][$key] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'img' => $img
                ];
            }

            $products_2 = ProductTag::where('tag', 'like', '%' . $request->p . '%')->get();
            foreach ($products_2 as $key => $product) {
                if ($product->product()->first()->enabled == 1) {
                    $img = $pdc->get_product_image($product->product()->first());
                    $out['products'][$key] = [
                        'id' => $product->product()->first()->id,
                        'name' => $product->product()->first()->name,
                        'quantity' => $product->product()->first()->quantity,
                        'img' => $img
                    ];
                }
            }

            $products = '';

            if ($out) {
                foreach ($out['products'] as $key => $product) {
                    $products = $products . $this::create_product_from_template([
                            'id' => $product["id"],
                            'img' => $product["img"],
                            'name' => $product["name"]
                        ]);
                }

                return $products;
            } else {
                $products = $this::create_product_from_template([
                    'id' => '#',
                    'img' => 'img/no-image.png',
                    'name' => 'No Product Found'
                ]);

                return $products;
            }
        } else {
            $out = array();
            $products_1 = Product::where('enabled', '=', 1)->get();
            foreach ($products_1 as $key => $product) {
                $img = $product->imgs()->first();
                if ($img) {
                    $img = 'product-imgs/' . $product->imgs()->first()->img;
                } else {
                    $img = 'img/' . 'no-image.png';
                }
                $out['products'][$key] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'img' => $img
                ];
            }

            return view('layouts.bid_management', $out);
        }
    }

    public function get_active_bid_time_left(Request $request)
    {
        $out = array();
        $bids = BidPlan::whereIn('id', $request->b)
            ->get();
        $now = Carbon::now();
        foreach ($bids as $key => $bid) {
            $start = Carbon::parse($bid->start);
            $end = Carbon::parse($bid->end)->subSeconds(30);
            if ($now->lte($end)) {
                $date_diff = $end->diffInSeconds($now);
                $out[$bid->id] = [
                    $date_diff,
                    BidUserController::last_bidder($bid->id),
                    $bid->entries * $bid->increment,
                    $bid->entries
                ];
            } else {
                if ($bid->status == 2) {
                    $out[$bid->id]['s'] = 3;
                    $winner = $bid->winner()->first();
                    if ($winner) {
                        if ($winner->nick_name) {
                            $nick_name = $winner->nick_name;
                        } else {
                            $nick_name = $winner->first_name . $winner->last_name;
                        }
                    } else {
                        $nick_name = 'No Winner';
                    }
                    $out[$bid->id]['w'] = $nick_name;
                } else {
                    $out[$bid->id]['s'] = 2;
                }

            }
        }

        return response()->json($out);
    }

    public function evaluate_bids()
    {
        // Raffle Bid
        $bids = BidPlan::where('status', 1)->get();
        $now = Carbon::now();
        foreach ($bids as $bid) {
            $end = Carbon::parse($bid->end);
            if ($now->gte($end)) {
                $bid->status = 2;
                $bid->save();
                $users = BidUser::where('bid_id', $bid->id)
                    ->orderBy('created_at', 'desc')
                    ->first();
                if ($users) {
                    $bid_winner = $users->user_id;
                    $bid->winner_id = $bid_winner;
                    $bid->save();
                    $product = Product::where('id', $bid->product_id)->first();
                    // TODO : Send notification emails to all participants
                    // $product->quantity -= 1;
                    // $product->save();
                    $this::send_mail_winner([
                        'bid_id' => 'A' . str_pad($bid->id, 6, '0', STR_PAD_LEFT),
                        'winner_name' => $bid->winner()->first()->first_name,
                        'winner_email' => $bid->winner()->first()->email,
                        'item_name' => $product->name
                    ]);
                }
            }
        }
    }

    public function send_mail_winner($winner)
    {
        $email = [
            'type' => 'winner',
            'winner' => $winner,
            'template' => 'emails.bid_winner',
            'from' => 'Hoseh Services',
            'subject' => '[' . $winner['bid_id'] . ' ] You won ' . $winner['item_name'] . ' from hoseh.com auction - Congratulations!'
        ];
        $this->dispatch(new SendEmail($email));
    }

    public function send_mail_non_winners($non_winners)
    {
        foreach ($non_winners as $non_winner) {
            $email = [
                'type' => 'non-winner',
                'non_winner' => $non_winner,
                'template' => 'emails.bid_non_winners',
                'from' => 'Hoseh Services',
                'subject' => '[' . $non_winners['bid_id'] . ' ] The auction for ' . $non_winner['item_name'] . ' from hoseh.com has ended'
            ];
            $this->dispatch(new SendEmail($email));
        }
    }

    public function show_bid_participants(Request $request)
    {
        $b = BidPlan::where('id', $request->b)->first();
        if ($b) {
            if ($request->u == $b->updated_at) {
                return [0];
            } else {
                $participants = array();
                if ($b) {
                    $b_us = $b->bids()->get();
                    foreach ($b_us as $key => $b_u) {
                        $participants[] = $b_u->user()->first()->nick_name;
                    }

                    return [1, date('Y-m-d H:i:s', $b->updated_at->getTimestamp()), $participants];
                }
            }
        }
    }

    function format_time($t, $f = ':') // t = seconds, f = separator
    {
        return sprintf("%02d%s%02d%s%02d", floor($t / 3600), $f, ($t / 60) % 60, $f, $t % 60);
    }

}

// Draw Status
//  1 - Active
//  2 - Completed
//  3 - Purchased
//  4 - Delivered
