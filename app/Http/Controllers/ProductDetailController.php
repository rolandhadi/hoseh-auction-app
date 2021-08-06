<?php

namespace App\Http\Controllers;

use Excel;
use App\Product;
use App\ProductTag;
use App\ProductImage;
use App\DrawPlan;
use App\BidPlan;
use App\DrawPurchase;
use App\BidPurchase;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProductDetailController extends Controller
{
    public function show(Request $request)
    {
        if ($request->p) {
            $details = array();
            $p = Product::where('id', '=', $request->p)->first();
            if ($p) {
                if ($request->m == 'p') {
                    $m['url'] = '/p/m';
                    $m['text'] = 'Product Management';
                } elseif ($request->m == 'b') {
                    $m['url'] = '/b/m';
                    $m['text'] = 'Auction Management';
                } elseif ($request->m == 'h' || $request->m == 'rdw' || $request->m == 'udw' || $request->m == 'd') {
                    if ($request->m == 'rdw') {
                        $m['url'] = '/r/d/w';
                        $m['text'] = 'Luck Draw Winners';
                    } elseif ($request->m == 'udw') {
                        $m['url'] = '/u/d/w';
                        $m['text'] = 'Won Luck Draws';
                    } elseif ($request->m == 'd') {
                        $m['url'] = '/d/m';
                        $m['text'] = 'Lucky Draw Management';
                    } else {
                        $m['url'] = '/';
                        $m['text'] = 'Active Lucky Draws';
                    }
                    $details = array();
                    $participants = array();
                    if ($request->d) {
                        $d = DrawPlan::where('id', '=', $request->d)->first();
                        $d_draws = $d->draws()->orderBy('id', 'desc')->get();
                        $d_us = $d_draws->take(3);
                        $d_count = $d->entries;
                        foreach ($d_us as $key => $d_u) {
                            $participants[] = [
                                'user' => $d_u->user()->first()->nick_name
                            ];
                        }
                        if ($d->winner_id) {
                            $winner_id = $d->winner()->first()->id;
                            $winner_name = $d->winner()->first()->nick_name;
                        } else {
                            $winner_id = null;
                            $winner_name = 'No Winner';
                        }
                        $details = [
                            'type' => 'draw',
                            'updated_at' => date('Y-m-d H:i:s', $d->updated_at->getTimestamp()),
                            'id' => $d->id,
                            'draw_id' => 'D' . str_pad($d->id, 6, '0', STR_PAD_LEFT),
                            'status' => $d->status,
                            'winner_id' => $winner_id,
                            'winner_name' => $winner_name,
                            'return_token' => $d->return_tokens(session('user_id'))->count(),
                            'bought' => $d->purchases()->count(),
                            'participants' => $participants,
                            'total_participants' => $d_count
                        ];
                    }
                } elseif ($request->m == 'hb' || $request->m == 'rbw' || $request->m == 'ubw' || $request->m == 'b') {
                    if ($request->m == 'rbw') {
                        $m['url'] = '/r/b/w';
                        $m['text'] = 'Auction Draw Winners';
                    } elseif ($request->m == 'ubw') {
                        $m['url'] = '/u/b/w';
                        $m['text'] = 'Won Auctions';
                    } elseif ($request->m == 'b') {
                        $m['url'] = '/b/m';
                        $m['text'] = 'Active Auction Management';
                    } else {
                        $m['url'] = '/b';
                        $m['text'] = 'Active Auctions';
                    }
                    $details = array();
                    $participants = array();
                    if ($request->b) {
                        $b = BidPlan::where('id', '=', $request->b)->first();
                        $b_bids = $b->bids()->orderBy('id', 'desc')->get();
                        $b_us = $b_bids->take(3);
                        $bid_count = $b->entries;
                        foreach ($b_us as $key => $b_u) {
                            $participants[] = [
                                'user' => $b_u->user()->first()->nick_name,
                                'bid' => $bid_count * $b->increment
                            ];
                            $bid_count--;
                        }
                        if ($b->winner_id) {
                            $winner_id = $b->winner()->first()->id;
                            $winner_name = $b->winner()->first()->nick_name;
                        } else {
                            $winner_id = null;
                            $winner_name = 'No Winner';
                        }
                        $product_price = $b->product()->first()->price;
                        $bid_price = $b->increment * $b->entries;
                        $savings = $product_price - $bid_price;
                        if ($savings) {
                          $percent_savings = round(($savings / $product_price) * 100);
                        }
                        else {
                          $percent_savings = 100;
                        }
                        $details = [
                            'type' => 'bid',
                            'updated_at' => date('Y-m-d H:i:s', $b->updated_at->getTimestamp()),
                            'id' => $b->id,
                            'bid_id' => 'A' . str_pad($b->id, 6, '0', STR_PAD_LEFT),
                            'status' => $b->status,
                            'winner_id' => $winner_id,
                            'winner_name' => $winner_name,
                            'bid_price' => ($b->entries * $b->increment),
                            'savings' => 'S$ ' . ($savings) . ' (' . $percent_savings . '%)',
                            'bid_increment' => $b->increment,
                            'return_token' => $b->return_tokens(session('user_id'))->count(),
                            'bought' => $b->purchases()->count(),
                            'participants' => $participants,
                            'total_bids' => $b->entries
                        ];
                    }
                } else {
                    $m['url'] = '/';
                    $m['text'] = 'Home';
                }
                $out = [
                    'p_url' => $m['url'],
                    'p_m' => $request->m,
                    'p_parent' => $m['text'],
                    'p_id' => $p->id,
                    'p_name' => $p->name,
                    'p_desc' => $p->desc,
                    'p_quantity' => $p->quantity,
                    'p_price' => $p->price,
                    'p_delivery_charge' => $p->delivery_charge,
                    'p_details' => $details
                ];
                $tags = $this::get_tags($p->id);
                $ids = $this::get_images($p->id);
                if ($ids) {
                    $ids = $ids->pluck('id');
                }
                $imgs = $this::get_images($p->id);
                if ($imgs) {
                    $imgs = $imgs->pluck('img');
                }
                if (session('user_id') == 1 && !(($request->d) || ($request->b))) {
                    return view('layouts.admin_product_detail', $out)->with('tags', $tags)->with('ids',
                        $ids)->with('imgs', $imgs);
                } else {
                    if ($request->success === 'true') {
                        $message = ['Payment Completed', 'Payment was successfull', 'success'];
                    } else {
                        if ($request->success === 'false') {
                            $message = ['Payment Error', 'Transaction Failed. Please try again later.', 'error'];
                        } else {
                            $message = null;
                        }
                    }
                    $out['p_desc'] = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.-]*(\?\S+)?)?)?)@',
                        '<a href="$1">$1</a>', $out['p_desc']);

                    return view('layouts.product_detail', $out)->with('tags', $tags)
                        ->with('ids', $ids)
                        ->with('imgs', $imgs)
                        ->with('message', $message);
                }
            }
        }
    }

    public function get_product_image($product)
    {
        $img = $product->imgs()->first();
        if ($img) {
            $img = 'product-imgs/' . $product->imgs()->first()->img;
        } else {
            $img = 'img/' . 'no-image.png';
        }

        return $img;
    }

    public function add_image(Request $request)
    {
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $v = explode('|', $request->p);
                $p = Product::where('id', '=', $v[1])->first();
                if ($p) {
                    $i = new ProductImage;
                    $i->product_id = $v[1];
                    if ($i->save()) {
                        $i->img = $i->id . '.' . pathinfo($request->file('image')->getClientOriginalName(),
                                PATHINFO_EXTENSION);
                        $request->file('image')->move(public_path('product-imgs'), $i->img);
                        $i->save();

                        return redirect($v[0] . $v[1] . '&m=' . $v[2]);
                    }
                }
            }
        }
    }

    public function update_product(Request $request)
    {
        $p = Product::where('id', '=', $request->p)->first();
        if ($p) {
            $p->name = $request->n;
            $p->desc = $request->d;
            $p->quantity = $request->q;
            $p->delivery_charge = $request->dc;
            $p->price = $request->pr;
            if ($p->save()) {
                return [1, $p->name . ' updated successfully', '/p/m'];
            } else {
                return [1, $p->name . ' was not updated successfully'];
            }
        }
    }

    public function delete_product(Request $request)
    {
        $p = Product::where('id', '=', $request->p)->first();
        if ($p) {
            $p->enabled = 0;
            if ($p->save()) {
                return [1, $p->name . ' deleted successfully'];
            } else {
                return [0, $p->name . ' was not deleted successfully'];
            }
        }
    }

    public function get_tags($p)
    {
        if ($p) {
            $t = ProductTag::where('product_id', '=', $p)->get();
            if ($t) {
                return $t;
            }
        }
    }

    public function get_images($p)
    {
        if ($p) {
            $i = ProductImage::where('product_id', '=', $p)->get();
            if ($i) {
                return $i;
            }
        }
    }

    public function add_tag(Request $request)
    {
        $p = Product::where('id', '=', $request->p)->first();
        if ($p) {
            $t = new ProductTag;
            $t->product_id = $request->p;
            $t->tag = $request->t;
            if ($t->save()) {
                return ['id' => $t->id, 'text' => $t->tag];
            }
        }
    }

    public function delete_tag(Request $request)
    {
        $t = ProductTag::find($request->t);
        if ($t) {
            $t->delete();

            return 1;
        }
    }

    public function delete_image(Request $request)
    {
        $i = ProductImage::find($request->i);
        if ($i) {
            $v = explode('|', $request->p);
            $i->delete();
            unlink(public_path('product-imgs/') . $i->img);
            $out = [1, 'Product image deleted successfully', $v[0] . $v[1] . '&m=' . $v[2]];

            return $out;
        }
    }

    public function product_draw_purchase_histories()
    {
        $purchases = DrawPurchase::orderBy('id', 'desc')->whereIn('status', ['2', '3', '4'])->paginate(25);
        $draw_plan_count = DrawPlan::where('status', '3')->count();
        $bid_plan_count = BidPlan::where('status', '3')->count();
        $draw_purchase_count = DrawPurchase::where('status', '3')->count();
        $bid_purchase_count = BidPurchase::where('status', '3')->count();
        if ($draw_plan_count) {
            $out['draw_delivery'] = '<span class="badge">' . $draw_plan_count . '</span>';
        } else {
            $out['draw_delivery'] = '';
        }
        if ($bid_plan_count) {
            $out['bid_delivery'] = '<span class="badge">' . $bid_plan_count . '</span>';
        } else {
            $out['bid_delivery'] = '';
        }
        if ($draw_purchase_count) {
            $out['draw_purchase_delivery'] = '<span class="badge">' . $draw_purchase_count . '</span>';
        } else {
            $out['draw_purchase_delivery'] = '';
        }
        if ($bid_purchase_count) {
            $out['bid_purchase_delivery'] = '<span class="badge">' . $bid_purchase_count . '</span>';
        } else {
            $out['bid_purchase_delivery'] = '';
        }
        $out['users_purchase_total'] = DrawPurchase::whereIn('status', ['2', '3', '4'])->count();
        $out['users_purchase_history'] = $purchases->links();
        foreach ($purchases as $d => $purchase) {
            $product_purchase_purchase = $purchase->winner()->first();
            if ($product_purchase_purchase) {
                $product_purchase_purchase_id = $product_purchase_purchase->id;
                $product_purchase_purchase_email = $product_purchase_purchase->email;
            } else {
                $product_purchase_purchase_id = 0;
                $product_purchase_purchase_email = '';
            }
            $out['purchases'][$d] = [
                'created_at' => $purchase->updated_at,
                'winner_id' => $product_purchase_purchase_id,
                'email' => $product_purchase_purchase_email,
                'purchase_id' => $purchase->id,
                'invoice_id' => $purchase->invoice_id,
                'item_name' => $purchase->draw()->first()->product()->first()->name,
                'product_id' => $purchase->draw()->first()->product()->first()->id,
                'item_status' => $purchase->status,
                'item_image' => 'product-imgs/' . $purchase->draw()->first()->product()->first()->imgs()->first()->img
            ];
        }

        return view('layouts.users_buy_draw_history')->with('purchases', $out);
    }


    public function export_product_draw_purchase_histories()
    {
        $out = array();
        $purchases = DrawPurchase::orderBy('id', 'desc')->whereIn('status', ['2', '3', '4'])->get();
        foreach ($purchases as $d => $purchase) {
            $product_purchase_purchase = $purchase->winner()->first();
            if ($product_purchase_purchase) {
                $product_purchase_purchase_id = $product_purchase_purchase->id;
                $product_purchase_purchase_email = $product_purchase_purchase->email;
            } else {
                $product_purchase_purchase_id = 0;
                $product_purchase_purchase_email = '';
            }
            if ($purchase->status == 0) {
                $remarks = 'UNKNOWN';
            } else {
                if ($purchase->status == 1) {
                    $remarks = 'Active';
                } else {
                    if ($purchase->status == 2) {
                        $remarks = 'Completed';
                    } else {
                        if ($purchase->status == 3) {
                            $remarks = 'For Delivery';
                        } else {
                            if ($purchase->status == 4) {
                                $remarks = 'Delivered';
                            } else {
                                $remarks = 'UNKNOWN';
                            }
                        }
                    }
                }
            }
            $out[] = [
                'DATE' => $purchase->updated_at,
                'EMAIL' => $product_purchase_purchase_email,
                'INVOICE_NO' => $purchase->invoice_id,
                'PRODUCT_NAME' => $purchase->draw()->first()->product()->first()->name,
                'REMARKS' => $remarks
            ];
        }
        if ($out) {
            Excel::create('exported_draw_purchases', function ($excel) use ($out) {
                $excel->sheet('exported_draw_purchases', function ($sheet) use ($out) {
                    $sheet->fromArray($out);
                });
            })->export('xls');
        }
    }

    public function product_draw_purchase_history(Request $request)
    {
        $purchases = DrawPurchase::orderBy('id', 'desc')->whereIn('status', ['2', '3', '4'])
            ->where('user_id', session('user_id'))
            ->paginate(25);
        $out['users_purchase_total'] = DrawPurchase::whereIn('status', ['2', '3', '4'])
            ->where('user_id', session('user_id'))
            ->count();
        $out['users_purchase_history'] = $purchases->links();
        foreach ($purchases as $d => $purchase) {
            $out['purchases'][$d] = [
                'created_at' => $purchase->updated_at,
                'purchase_id' => $purchase->id,
                'invoice_id' => $purchase->invoice_id,
                'product_id' => $purchase->draw()->first()->product()->first()->id,
                'item_name' => $purchase->draw()->first()->product()->first()->name,
                'item_status' => $purchase->status,
                'item_image' => 'product-imgs/' . $purchase->draw()->first()->product()->first()->imgs()->first()->img
            ];
        }
        if ($request->success === 'true') {
            $message = ['Payment Completed', 'Payment was successfull', 'success'];
        } else {
            if ($request->success === 'false') {
                $message = ['Payment Error', 'Transaction Failed. Please try again later.', 'error'];
            } else {
                $message = null;
            }
        }

        return view('layouts.user_buy_draw_history')->with('purchases', $out)
            ->with('message', $message);
    }

    public function product_draw_purchase_action(Request $request)
    {
        $item_remarks = '';
        $purchase = DrawPurchase::where('id', $request->a)
            ->first();
        $product_purchase_purchase = $purchase->winner()->first();
        if ($product_purchase_purchase) {
            $product_purchase_purchase_email = $product_purchase_purchase->email;
            $product_purchase_purchase_address = $product_purchase_purchase->address;
            $product_purchase_purchase = $product_purchase_purchase->first_name . ' ' . $product_purchase_purchase->last_name;
        } else {
            $product_purchase_purchase_email = '';
            $product_purchase_purchase_address = '';
            $product_purchase_purchase = '';
        }
        if ($purchase->status == 2) {
            $item_remarks = 'PENDING PAYMENT';
        } elseif ($purchase->status == 3) {
            $item_remarks = 'FOR DELIVERY';
        } elseif ($purchase->status == 4) {
            $item_remarks = 'DELIVERED';
        }
        $purchase = [
            'created_at' => $purchase->updated_at,
            'email' => $product_purchase_purchase_email,
            'address' => $product_purchase_purchase_address,
            'full_name' => $product_purchase_purchase,
            'purchase_id' => $purchase->id,
            'invoice_id' => $purchase->invoice_id,
            'item_name' => $purchase->draw()->first()->product()->first()->name,
            'item_status' => $item_remarks,
            'item_image' => asset('product-imgs/' . $purchase->draw()->first()->product()->first()->imgs()->first()->img)
        ];
        $out = [
            1,
            'User Purchased ' . $purchase['item_name'],
            '<div class="row">
        <div class="col-sm-3">
          <div class="form-group">
            <label class="control-label">Invoice ID</label>
            <div class="form-control"> ' . $purchase['invoice_id'] . ' </div>
          </div>
          <img src="' . $purchase['item_image'] . '" />
        </div>
        <div class="col-sm-9">
          <div class="form-group">
            <label class="control-label">Email</label>
            <div class="form-control"> ' . $purchase['email'] . ' </div>
          </div>
          <div class="form-group">
            <label class="control-label">Name</label>
            <div class="form-control"> ' . $purchase['full_name'] . ' </div>
          </div>
          <div class="form-group">
              <label class="control-label">Delivery Address</label>
              <div class="form-control"> ' . $purchase['address'] . ' </div>
          </div>
          <div class="form-group">
              <label class="control-label">Remarks</label>
              <div class="form-control"> ' . $purchase['item_status'] . ' </div>
          </div>
        </div>
      </div>
      '
        ];

        return $out;
    }

    public function product_draw_purchase_action_delivered(Request $request)
    {
        $purchase = DrawPurchase::where('id', $request->a)
            ->first();
        if ($purchase) {
            if ($purchase->status == 3) {
                $purchase->status = 4;
                $purchase->save();

                return [1, 'Delivery', 'Item was marked for delivery', 'success'];
            } elseif ($purchase->status == 4) {
                return [1, 'Delivery', 'Item was already marked for delivery', 'success'];
            } else {
                return [0, 'Delivery', 'Item was not marked for delivery', 'error'];
            }
        } else {
            return [0, 'Delivery', 'Item was not marked for delivery', 'error'];
        }
    }


    public function product_bid_purchase_histories()
    {
        $purchases = BidPurchase::orderBy('id', 'desc')->whereIn('status', ['2', '3', '4'])->paginate(25);
        $draw_plan_count = DrawPlan::where('status', '3')->count();
        $bid_plan_count = BidPlan::where('status', '3')->count();
        $draw_purchase_count = DrawPurchase::where('status', '3')->count();
        $bid_purchase_count = BidPurchase::where('status', '3')->count();
        if ($draw_plan_count) {
            $out['draw_delivery'] = '<span class="badge">' . $draw_plan_count . '</span>';
        } else {
            $out['draw_delivery'] = '';
        }
        if ($bid_plan_count) {
            $out['bid_delivery'] = '<span class="badge">' . $bid_plan_count . '</span>';
        } else {
            $out['bid_delivery'] = '';
        }
        if ($draw_purchase_count) {
            $out['draw_purchase_delivery'] = '<span class="badge">' . $draw_purchase_count . '</span>';
        } else {
            $out['draw_purchase_delivery'] = '';
        }
        if ($bid_purchase_count) {
            $out['bid_purchase_delivery'] = '<span class="badge">' . $bid_purchase_count . '</span>';
        } else {
            $out['bid_purchase_delivery'] = '';
        }
        $out['users_purchase_total'] = BidPurchase::whereIn('status', ['2', '3', '4'])->count();
        $out['users_purchase_history'] = $purchases->links();
        foreach ($purchases as $d => $purchase) {
            $product_purchase_purchase = $purchase->winner()->first();
            if ($product_purchase_purchase) {
                $product_purchase_purchase_id = $product_purchase_purchase->id;
                $product_purchase_purchase_email = $product_purchase_purchase->email;
            } else {
                $product_purchase_purchase_id = 0;
                $product_purchase_purchase_email = '';
            }
            $out['purchases'][$d] = [
                'created_at' => $purchase->updated_at,
                'winner_id' => $product_purchase_purchase_id,
                'email' => $product_purchase_purchase_email,
                'purchase_id' => $purchase->id,
                'invoice_id' => $purchase->invoice_id,
                'item_name' => $purchase->bid()->first()->product()->first()->name,
                'product_id' => $purchase->bid()->first()->product()->first()->id,
                'item_status' => $purchase->status,
                'item_image' => 'product-imgs/' . $purchase->bid()->first()->product()->first()->imgs()->first()->img
            ];
        }

        return view('layouts.users_buy_bid_history')->with('purchases', $out);
    }

    public function product_bid_purchase_history(Request $request)
    {
        $purchases = BidPurchase::orderBy('id', 'desc')->whereIn('status', ['2', '3', '4'])
            ->where('user_id', session('user_id'))
            ->paginate(25);
        $out['users_purchase_total'] = BidPurchase::whereIn('status', ['2', '3', '4'])
            ->where('user_id', session('user_id'))
            ->count();
        $out['users_purchase_history'] = $purchases->links();
        foreach ($purchases as $d => $purchase) {
            $out['purchases'][$d] = [
                'created_at' => $purchase->updated_at,
                'purchase_id' => $purchase->id,
                'invoice_id' => $purchase->invoice_id,
                'product_id' => $purchase->bid()->first()->product()->first()->id,
                'item_name' => $purchase->bid()->first()->product()->first()->name,
                'item_status' => $purchase->status,
                'item_image' => 'product-imgs/' . $purchase->bid()->first()->product()->first()->imgs()->first()->img
            ];
        }
        if ($request->success === 'true') {
            $message = ['Payment Completed', 'Payment was successfull', 'success'];
        } else {
            if ($request->success === 'false') {
                $message = ['Payment Error', 'Transaction Failed. Please try again later.', 'error'];
            } else {
                $message = null;
            }
        }

        return view('layouts.user_buy_bid_history')->with('purchases', $out)
            ->with('message', $message);
    }

    public function export_product_bid_purchase_histories()
    {
        $out = array();
        $purchases = BidPurchase::orderBy('id', 'desc')->whereIn('status', ['2', '3', '4'])->get();
        foreach ($purchases as $d => $purchase) {
            $product_purchase_purchase = $purchase->winner()->first();
            if ($product_purchase_purchase) {
                $product_purchase_purchase_id = $product_purchase_purchase->id;
                $product_purchase_purchase_email = $product_purchase_purchase->email;
            } else {
                $product_purchase_purchase_id = 0;
                $product_purchase_purchase_email = '';
            }
            if ($purchase->status == 0) {
                $remarks = 'UNKNOWN';
            } else {
                if ($purchase->status == 1) {
                    $remarks = 'Active';
                } else {
                    if ($purchase->status == 2) {
                        $remarks = 'Completed';
                    } else {
                        if ($purchase->status == 3) {
                            $remarks = 'For Delivery';
                        } else {
                            if ($purchase->status == 4) {
                                $remarks = 'Delivered';
                            } else {
                                $remarks = 'UNKNOWN';
                            }
                        }
                    }
                }
            }
            $out[] = [
                'DATE' => $purchase->updated_at,
                'EMAIL' => $product_purchase_purchase_email,
                'INVOICE_ID' => $purchase->invoice_id,
                'PRODUCT_NAME' => $purchase->bid()->first()->product()->first()->name,
                'REMARKS' => $remarks
            ];
        }
        if ($out) {
            Excel::create('exported_auction_purchases', function ($excel) use ($out) {
                $excel->sheet('exported_auction_purchases', function ($sheet) use ($out) {
                    $sheet->fromArray($out);
                });
            })->export('xls');
        }
    }


    public function product_bid_purchase_action(Request $request)
    {
        $item_remarks = '';
        $purchase = BidPurchase::where('id', $request->a)
            ->first();
        $product_purchase_purchase = $purchase->winner()->first();
        if ($product_purchase_purchase) {
            $product_purchase_purchase_email = $product_purchase_purchase->email;
            $product_purchase_purchase_address = $product_purchase_purchase->address;
            $product_purchase_purchase = $product_purchase_purchase->first_name . ' ' . $product_purchase_purchase->last_name;
        } else {
            $product_purchase_purchase_email = '';
            $product_purchase_purchase_address = '';
            $product_purchase_purchase = '';
        }
        if ($purchase->status == 2) {
            $item_remarks = 'PENDING PAYMENT';
        } elseif ($purchase->status == 3) {
            $item_remarks = 'FOR DELIVERY';
        } elseif ($purchase->status == 4) {
            $item_remarks = 'DELIVERED';
        }
        $purchase = [
            'created_at' => $purchase->updated_at,
            'email' => $product_purchase_purchase_email,
            'address' => $product_purchase_purchase_address,
            'full_name' => $product_purchase_purchase,
            'purchase_id' => $purchase->id,
            'invoice_id' => $purchase->invoice_id,
            'item_name' => $purchase->bid()->first()->product()->first()->name,
            'item_status' => $item_remarks,
            'item_image' => asset('product-imgs/' . $purchase->bid()->first()->product()->first()->imgs()->first()->img)
        ];
        $out = [
            1,
            'User Purchased ' . $purchase['item_name'],
            '<div class="row">
        <div class="col-sm-3">
          <div class="form-group">
            <label class="control-label">Invoice ID</label>
            <div class="form-control"> ' . $purchase['invoice_id'] . ' </div>
          </div>
          <img src="' . $purchase['item_image'] . '" />
        </div>
        <div class="col-sm-9">
          <div class="form-group">
            <label class="control-label">Email</label>
            <div class="form-control"> ' . $purchase['email'] . ' </div>
          </div>
          <div class="form-group">
            <label class="control-label">Name</label>
            <div class="form-control"> ' . $purchase['full_name'] . ' </div>
          </div>
          <div class="form-group">
              <label class="control-label">Delivery Address</label>
              <div class="form-control"> ' . $purchase['address'] . ' </div>
          </div>
          <div class="form-group">
              <label class="control-label">Remarks</label>
              <div class="form-control"> ' . $purchase['item_status'] . ' </div>
          </div>
        </div>
      </div>
      '
        ];

        return $out;
    }

    public function product_bid_purchase_action_delivered(Request $request)
    {
        $purchase = BidPurchase::where('id', $request->a)
            ->first();
        if ($purchase) {
            if ($purchase->status == 3) {
                $purchase->status = 4;
                $purchase->save();

                return [1, 'Delivery', 'Item was marked for delivery', 'success'];
            } elseif ($purchase->status == 4) {
                return [1, 'Delivery', 'Item was already marked for delivery', 'success'];
            } else {
                return [0, 'Delivery', 'Item was not marked for delivery', 'error'];
            }
        } else {
            return [0, 'Delivery', 'Item was not marked for delivery', 'error'];
        }
    }

}
