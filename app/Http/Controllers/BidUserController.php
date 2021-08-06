<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use Excel;
use App\User;
use App\BidUser;
use App\DrawPlan;
use App\BidPlan;
use App\DrawPurchase;
use App\BidPurchase;
use Carbon\Carbon;
use App\Http\Requests;

class BidUserController extends Controller
{
    public static function last_bidder($bid)
    {
        $last_bid = BidUser::where('bid_id', $bid)
            ->orderBy('created_at', 'desc')
            ->first();
        if ($last_bid) {
            return $last_bid->user()->first()->nick_name;
        } else {
            return '';
        }
    }

    public function join_bid(Request $request)
    {
        if (session('user_id') != null) {
            $u = User::where('id', session('user_id'))->first();
            $d = BidPlan::where('id', $request->b)
                ->where('status', 1)
                ->first();
            if ($d) {
                $now = Carbon::now();
                $start = Carbon::parse($d->start);
                $end = Carbon::parse($d->end)->subSeconds(30);
                if ($now->lte($end)) {
                    if ($u->tokens) {
                        $du = new BidUser;
                        $du->user_id = session('user_id');
                        $du->bid_id = $request->b;
                        $du->amount = 1;
                        if ($du->save()) {
                            $d->end = Carbon::parse($d->end)->addSeconds(10);
                            $d->entries += 1;
                            $d->save();
                            $u->tokens -= 1;
                            $u->save();
                            // // $this::send_mail_joiner([
                            //   'bid_id' => 'A' . str_pad($du->bid()->first()->id, 6, '0', STR_PAD_LEFT),
                            //   'joiner_name' => $du->user()->first()->first_name,
                            //   'joiner_email' => $du->user()->first()->email,
                            //   'item_name' => $du->bid()->first()->product()->first()->name
                            // ]);
                            return [1, 'You joined the Bid!', $u->tokens];
                        } else {
                            return [0, 'Error', 'Cannot join Bid'];
                        }
                    } else {
                        return [0, 'Insufficient Token', 'Purchase tokens to join'];
                    }
                } else {
                    return [0, 'Times Up', 'Auction is over'];
                }
            } else {
                return [0, 'Error', 'Cannot join Bid'];
            }
        } else {
            return [0, 'redirect', '/login'];
        }
    }

    public function send_mail_joiner($joiner)
    {
        Mail::send('emails.bid_joiner', ['joiner' => $joiner], function ($m) use ($joiner) {
            $m->from(config('services.hoseh_services.sender_email'), 'Hoseh Services');
            $m->to($joiner['joiner_email'], $joiner['joiner_name'])
                ->subject('[' . $joiner['bid_id'] . ' ] You joined the auction for ' . $joiner['item_name'] . ' from hoseh.com auctions - good luck!');
        });
    }

    public function bid_histories()
    {
        $bids = BidUser::orderBy('id', 'desc')->paginate(25);
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
        $out['users_bid_total'] = BidUser::count();
        $out['users_bid_history'] = $bids->links();
        foreach ($bids as $b => $bid) {
            $out['bids'][$b] = [
                'created_at' => $bid->created_at,
                'winner_id' => $bid->user()->first()->id,
                'email' => $bid->user()->first()->email,
                'bid_id' => $bid->id,
                'item_name' => $bid->bid()->first()->product()->first()->name,
                'item_image' => 'product-imgs/' . $bid->bid()->first()->product()->first()->imgs()->first()->img
            ];
        }

        return view('layouts.users_bid_history')->with('bids', $out);
    }

    public function export_bid_histories()
    {
        $out = array();
        $bids = BidUser::orderBy('id', 'desc')->get();
        foreach ($bids as $b => $bid) {
            $out[] = [
                'DATE' => $bid->created_at,
                'EMAIL' => $bid->user()->first()->email,
                'AUCTION_ID' => 'A' . str_pad($bid->id, 6, '0', STR_PAD_LEFT),
                'PRODUCT_NAME' => $bid->bid()->first()->product()->first()->name
            ];
        }
        if ($out) {
            Excel::create('exported_auctions', function ($excel) use ($out) {
                $excel->sheet('exported_auctions', function ($sheet) use ($out) {
                    $sheet->fromArray($out);
                });
            })->export('xls');
        }
    }

    public function bid_winner_histories()
    {
        $bids = BidPlan::orderBy('id', 'desc')->whereIn('status', ['2', '3', '4'])
                                              ->whereNotNull('winner_id')
                                              ->paginate(25);
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
        $out['users_bid_total'] = BidPlan::whereIn('status', ['2', '3', '4'])
                                          ->whereNotNull('winner_id')
                                          ->count();
        $out['users_bid_history'] = $bids->links();
        foreach ($bids as $b => $bid) {
            $bid_winner = $bid->winner()->first();
            if ($bid_winner) {
                $bid_winner_id = $bid_winner->id;
                $bid_winner_email = $bid_winner->email;
            } else {
                $bid_winner_id = 0;
                $bid_winner_email = '';
            }
            $out['bids'][$b] = [
                'created_at' => $bid->updated_at,
                'winner_id' => $bid_winner_id,
                'email' => $bid_winner_email,
                'bid_id' => $bid->id,
                'product_id' => $bid->product()->first()->id,
                'item_name' => $bid->product()->first()->name,
                'last_bid_price' => $bid->increment * $bid->entries,
                'item_status' => $bid->status,
                'item_image' => 'product-imgs/' . $bid->product()->first()->imgs()->first()->img
            ];
        }

        return view('layouts.users_bid_winner_history')->with('bids', $out);
    }

    public function export_bid_winner_histories()
    {
        $out = array();
        $bids = BidPlan::orderBy('id', 'desc')->whereIn('status', ['2', '3', '4'])
                                              ->whereNotNull('winner_id')
                                              ->get();
        foreach ($bids as $b => $bid) {
            $bid_winner = $bid->winner()->first();
            if ($bid_winner) {
                $bid_winner_id = $bid_winner->id;
                $bid_winner_email = $bid_winner->email;
            } else {
                $bid_winner_id = 0;
                $bid_winner_email = '';
            }
            if ($bid->status == 0) {
                $remarks = 'UNKNOWN';
            } else {
                if ($bid->status == 1) {
                    $remarks = 'Active';
                } else {
                    if ($bid->status == 2) {
                        $remarks = 'Completed';
                    } else {
                        if ($bid->status == 3) {
                            $remarks = 'For Delivery';
                        } else {
                            if ($bid->status == 4) {
                                $remarks = 'Delivered';
                            } else {
                                $remarks = 'UNKNOWN';
                            }
                        }
                    }
                }
            }
            $out[] = [
                'DATE' => $bid->updated_at,
                'EMAIL' => $bid_winner_email,
                'AUCTION_ID' => 'A' . str_pad($bid->id, 6, '0', STR_PAD_LEFT),
                'PRODUCT_NAME' => $bid->product()->first()->name,
                'LAST_BID_PRICE' => $bid->increment * $bid->entries,
                'REMARKS' => $remarks
            ];
        }
        if ($out) {
            Excel::create('exported_auction_winners', function ($excel) use ($out) {
                $excel->sheet('exported_auction_winners', function ($sheet) use ($out) {
                    $sheet->fromArray($out);
                });
            })->export('xls');
        }
    }

    public function bid_winner_history(Request $request)
    {
        $bids = BidPlan::orderBy('id', 'desc')->whereIn('status', ['2', '3', '4'])
            ->where('winner_id', session('user_id'))
            ->paginate(25);
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
        $out['users_bid_total'] = BidPlan::whereIn('status', ['2', '3', '4'])
            ->where('winner_id', session('user_id'))
            ->count();
        $out['users_bid_history'] = $bids->links();
        foreach ($bids as $d => $bid) {
            $out['bids'][$d] = [
                'created_at' => $bid->updated_at,
                'bid_id' => $bid->id,
                'product_id' => $bid->product()->first()->id,
                'item_name' => $bid->product()->first()->name,
                'last_bid_price' => $bid->increment * $bid->entries,
                'item_status' => $bid->status,
                'item_image' => 'product-imgs/' . $bid->product()->first()->imgs()->first()->img
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

        return view('layouts.user_bid_winner_history')->with('bids', $out)
            ->with('message', $message);
    }

    public function bid_winner_action(Request $request)
    {
        $item_remarks = '';
        $bid = BidPlan::where('id', $request->a)
            ->first();
        $bid_winner = $bid->winner()->first();
        if ($bid_winner) {
            $bid_winner_email = $bid_winner->email;
            $bid_winner_address = $bid_winner->address;
            $bid_winner = $bid_winner->first_name . ' ' . $bid_winner->last_name;
        } else {
            $bid_winner_email = '';
            $bid_winner_address = '';
            $bid_winner = '';
        }
        if ($bid->status == 2) {
            $item_remarks = 'PENDING PAYMENT';
        } elseif ($bid->status == 3) {
            $item_remarks = 'PAID';
        } elseif ($bid->status == 4) {
            $item_remarks = 'DELIVERED';
        }
        $bid = [
            'created_at' => $bid->updated_at,
            'email' => $bid_winner_email,
            'address' => $bid_winner_address,
            'full_name' => $bid_winner,
            'bid_id' => 'A' . str_pad($bid->id, 6, '0', STR_PAD_LEFT),
            'item_name' => $bid->product()->first()->name,
            'last_bid_price' => $bid->increment * $bid->entries,
            'item_status' => $item_remarks,
            'item_image' => asset('product-imgs/' . $bid->product()->first()->imgs()->first()->img)
        ];
        $out = [
            1,
            'Auction Winner of ' . $bid['item_name'],
            '<div class="row">
        <div class="col-sm-3">
          <div class="form-group">
            <label class="control-label">Auction ID</label>
            <div class="form-control"> ' . $bid['bid_id'] . ' </div>
          </div>
          <img src="' . $bid['item_image'] . '" />
        </div>
        <div class="col-sm-9">
          <div class="form-group">
            <label class="control-label">Email</label>
            <div class="form-control"> ' . $bid['email'] . ' </div>
          </div>
          <div class="form-group">
            <label class="control-label">Name</label>
            <div class="form-control"> ' . $bid['full_name'] . ' </div>
          </div>
          <div class="form-group">
              <label class="control-label">Delivery Address</label>
              <div class="form-control"> ' . $bid['address'] . ' </div>
          </div>
          <div class="form-group">
              <label class="control-label">Remarks</label>
              <div class="form-control"> ' . $bid['item_status'] . ' </div>
          </div>
        </div>
      </div>
      '
        ];

        return $out;
    }

    public function bid_winner_action_delivered(Request $request)
    {
        $bid = BidPlan::where('id', $request->a)
            ->first();
        if ($bid) {
            if ($bid->status == 3) {
                $bid->status = 4;
                $bid->save();

                return [1, 'Delivery', 'Item was marked for delivery', 'success'];
            } elseif ($bid->status == 4) {
                return [1, 'Delivery', 'Item was already marked for delivery', 'success'];
            } elseif ($bid->status == 2) {
                return [0, 'Delivery', 'Item is under pending payment', 'error'];
            } else {
                return [0, 'Delivery', 'Item was not marked for delivery', 'error'];
            }
        } else {
            return [0, 'Delivery', 'Item was not marked for delivery', 'error'];
        }
    }

}
