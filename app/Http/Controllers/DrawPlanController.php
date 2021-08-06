<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Product;
use App\DrawPlan;
use App\DrawUser;
use Carbon\Carbon;
use App\ProductTag;
use App\Http\Requests;
use App\Jobs\SendEmail;
use App\Http\Controllers\ProductDetailController;

class DrawPlanController extends Controller
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

        $active_draws = DrawPlan::where('status', 1)
            ->orderBy('end')
            ->paginate(20);
        $out['draw_links'] = $active_draws->links();
        if ($active_draws) {
            foreach ($active_draws as $key => $draw) {
                $img = $pdc->get_product_image($draw->product()->first());
                $out['active_draws'][$key] = [
                    'id' => $draw->id,
                    'product' => $draw->product()->first()->id,
                    'name' => $draw->product()->first()->name,
                    'img' => $img
                ];
            }
        }

        return view('layouts.draw_management', $out);
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

    public function save_draw(Request $request)
    {
        if ($request->a == 'add') {
            $d = new DrawPlan;
        } else {
            $d = DrawPlan::where('id', '=', $request->d)->first();
        }

        $d->product_id = $request->p;
        $d->start = $request->s;
        $d->end = $request->e;
        $d->status = 1;

        if ($d->save()) {
            return [1, $d->product()->first()->name . ' is saved successfully to the Lucky Draws', '/d/m'];
        } else {
            return [0, 'Cannot save the product to Lucky Draw'];
        }
    }

    public function delete_draw(Request $request)
    {
        $d = DrawPlan::where('id', '=', $request->d)
            ->where('status', 1)
            ->first();
        if ($d) {
            $d->status = 9;
            if ($d->save()) {
                $draw_users = $d->draws()->get();
                if ($draw_users) {
                    foreach ($draw_users as $draw_user) {
                        $user = User::where('id', $draw_user->user_id)->first();
                        if ($user) {
                            $user->tokens += 1;
                            $user->save();
                        }
                    }
                }

                return [1, $d->product()->first()->name . ' is deleted successfully from the lucky draw', '/d/m'];
            } else {
                return [0, 'Cannot delete the product to Lucky Draw'];
            }
        } else {
            return [0, 'Cannot delete the product to Lucky Draw'];
        }
    }

    public function update_active_draw_winner(Request $request)
    {
        $d = DrawPlan::where('id', '=', $request->d)->first();
        if ($request->u) {
            $user_id = $request->u;
        } else {
            $user_id = null;
        }
        $d->planned_winner_id = $user_id;
        if ($d->save()) {
            return [1, 'Lucky Draw winner updated'];
        } else {
            return [0, 'Cannot update the winner of the Lucky Draw'];
        }
    }

    public function show_draw(Request $request)
    {
        $out = '';
        $tags = '';
        $ids = '';
        $imgs = '';
        $action = '';
        $pdc = new ProductDetailController;
        if ($request->d) {
            $d = DrawPlan::where('id', '=', $request->d)->first();
            $d_id = $d->id;
            $d_start = $d->start;
            $d_end = $d->end;
            $p = Product::where('id', '=', $d->product_id)->first();
        } else {
            $d_id = 0;
            $d_start = Carbon::now()->addMinutes(10);
            $d_end = Carbon::now()->addMinutes(60);
            $p = Product::where('id', '=', $request->p)->first();
        }
        if ($p) {
            if ($request->m == 'p') {
                $m['url'] = '/p/m';
                $m['text'] = 'Product Management';
            } elseif ($request->m == 'd') {
                $m['url'] = '/d/m';
                $m['text'] = 'Lucky Draw Management';
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

        return view('layouts.draw_product_draw', $out)
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

            return view('layouts.draw_management', $out);
        }
    }

    public function get_active_draw_time_left(Request $request)
    {
        $out = array();
        $draws = DrawPlan::whereIn('id', $request->d)
            ->get();
        $now = Carbon::now();
        foreach ($draws as $key => $draw) {
            $start = Carbon::parse($draw->start);
            $end = Carbon::parse($draw->end)->subSeconds(30);
            if ($now->lte($end)) {
                $date_diff = $end->diffInSeconds($now);
                $out[$draw->id] = $date_diff;
            } else {
                if ($draw->status == 2) {
                    $out[$draw->id]['s'] = 3;
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
                    $out[$draw->id]['w'] = $nick_name;
                } else {
                    $out[$draw->id]['s'] = 2;
                }

            }
        }

        return response()->json($out);
    }

    public function evaluate_draws()
    {
        // Raffle Draw
        $draws = DrawPlan::where('status', 1)->get();
        $now = Carbon::now();
        foreach ($draws as $draw) {
            $end = Carbon::parse($draw->end);
            if ($now->gte($end)) {
                $draw->status = 2;
                $draw->save();
                $users = DrawUser::where('draw_id', $draw->id)->select('user_id')->get()->toArray();
                if (count($users)) {
                    if ($draw->planned_winner_id) {
                        $draw_winner = $draw->planned_winner_id;
                    } else {
                        $draw_winner = $users[array_rand($users)]['user_id'];
                    }
                    $draw->winner_id = $draw_winner;
                    $draw->save();
                    $product = Product::where('id', $draw->product_id)->first();
                    // $product->quantity -= 1;
                    // $product->save();
                    // TODO : Send notification emails to all participants
                    $this::send_mail_winner([
                        'draw_id' => 'D' . str_pad($draw->id, 6, '0', STR_PAD_LEFT),
                        'winner_name' => $draw->winner()->first()->first_name,
                        'winner_email' => $draw->winner()->first()->email,
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
            'template' => 'emails.draw_winner',
            'from' => 'Hoseh Services',
            'subject' => '[' . $winner['draw_id'] . ' ] You won ' . $winner['item_name'] . ' from hoseh.com lucky draw - Congratulations!'
        ];
        $this->dispatch(new SendEmail($email));
    }

    public function send_mail_non_winners($non_winners)
    {
        foreach ($non_winners as $non_winner) {
            $email = [
                'type' => 'non-winner',
                'non_winner' => $non_winner,
                'template' => 'emails.draw_non_winners',
                'from' => 'Hoseh Services',
                'subject' => '[' . $non_winners['draw_id'] . ' ] The lucky draw for ' . $non_winner['item_name'] . ' from hoseh.com has ended'
            ];
            $this->dispatch(new SendEmail($email));
        }
    }

    public function show_draw_participants(Request $request)
    {
        $d = DrawPlan::where('id', $request->d)->first();
        if ($d) {
            if ($request->u == $d->updated_at) {
                return [0];
            } else {
                $participants = array();
                if ($d) {
                    $d_us = $d->draws()->get();
                    foreach ($d_us as $key => $d_u) {
                        $participants[] = $d_u->user()->first()->nick_name;
                    }

                    return [1, date('Y-m-d H:i:s', $d->updated_at->getTimestamp()), $participants];
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
//  3 - Purchased (Default on Lucky Draw)
//  4 - Delivered
