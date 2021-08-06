<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use Excel;
use App\User;
use App\DrawUser;
use App\DrawPlan;
use App\BidPlan;
use App\DrawPurchase;
use App\BidPurchase;
use Carbon\Carbon;
use App\Http\Requests;

class DrawUserController extends Controller
{
    public function join_draw(Request $request)
    {
        if (session('user_id') != null) {
            $u = User::where('id', session('user_id'))->first();
            $d = DrawPlan::where('id', $request->d)
                ->where('status', 1)
                ->first();
            if ($d) {
                $now = Carbon::now();
                $start = Carbon::parse($d->start);
                $end = Carbon::parse($d->end)->subSeconds(30);
                if ($now->lte($end)) {
                    if ($u->tokens) {
                        $du = new DrawUser;
                        $du->user_id = session('user_id');
                        $du->draw_id = $request->d;
                        $du->amount = 1;
                        if ($du->save()) {
                            $d->entries += 1;
                            $d->save();
                            $u->tokens -= 1;
                            $u->save();
                            // // $this::send_mail_joiner([
                            //   'draw_id' => 'D' . str_pad($du->draw()->first()->id, 6, '0', STR_PAD_LEFT),
                            //   'joiner_name' => $du->user()->first()->first_name,
                            //   'joiner_email' => $du->user()->first()->email,
                            //   'item_name' => $du->draw()->first()->product()->first()->name
                            // ]);
                            return [1, 'You joined the lucky draw!', $u->tokens];
                        } else {
                            return [0, 'Error', 'Cannot join Lucky Draw'];
                        }
                    } else {
                        return [0, 'Insufficient Token', 'Purchase tokens to join'];
                    }
                } else {
                    return [0, 'Times Up', 'Lucky Draw is over'];
                }
            } else {
                return [0, 'Error', 'Cannot join Lucky Draw'];
            }
        } else {
            return [0, 'redirect', '/login'];
        }
    }

    public function send_mail_joiner($joiner)
    {
        Mail::send('emails.draw_joiner', ['joiner' => $joiner], function ($m) use ($joiner) {
            $m->from(config('services.hoseh_services.sender_email'), 'Hoseh Services');
            $m->to($joiner['joiner_email'], $joiner['joiner_name'])
                ->subject('[' . $joiner['draw_id'] . ' ] You joined the lucky draw for ' . $joiner['item_name'] . ' from hoseh.com lucky draw - good luck!');
        });
    }

    public function active_draw_histories()
    {
        $draw_plans = DrawPlan::where('status', 1)
            ->orderBy('id', 'desc')
            ->get();
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
        $out['draw_plans_total'] = count($draw_plans);

        foreach ($draw_plans as $d => $draw_plan) {
            $draw_users = $draw_plan->draws()->get();
            $participants = array();
            $users = array();
            $user_id = array();
            foreach ($draw_users as $draw_user) {
                $user = $draw_user->user()->first();
                $user_id[$user->id] = $user->nick_name;
                $users[] = $user->id;
            }
            $entries = array_count_values($users);
            foreach ($entries as $e => $entry) {
                $participants[] = [
                    'user_id' => $e,
                    'user_nick_name' => $user_id[$e] . ' ( ' . $entry . 'x )'
                ];
            }
            $out['draws'][$d] = [
                'draw_end_date' => $draw_plan->end,
                'draw_id' => $draw_plan->id,
                'item_name' => $draw_plan->product()->first()->name,
                'item_image' => 'product-imgs/' . $draw_plan->product()->first()->imgs()->first()->img,
                'participants' => $participants
            ];
        }

        return view('layouts.users_active_draw_history')->with('draws', $out);
    }


    public function export_active_draw_histories()
    {
        $out = array();

        $draw_plans = DrawPlan::where('status', 1)
            ->orderBy('id', 'desc')
            ->get();

        foreach ($draw_plans as $d => $draw_plan) {
            $out[] = [
                'DATE' => $draw_plan->end,
                'DRAW_ID' => 'D' . str_pad($draw_plan->id, 6, '0', STR_PAD_LEFT),
                'PRODUCT_NAME' => $draw_plan->product()->first()->name,
                'PARTICIPANTS' => $draw_plan->draws()->count()
            ];
        }
        if ($out) {
            Excel::create('exported_active_draw', function ($excel) use ($out) {
                $excel->sheet('exported_active_draw', function ($sheet) use ($out) {
                    $sheet->fromArray($out);
                });
            })->export('xls');
        }
    }

    public function draw_histories()
    {
        $draws = DrawUser::orderBy('id', 'desc')->paginate(25);
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
        $out['users_draw_total'] = DrawUser::count();
        $out['users_draw_history'] = $draws->links();
        foreach ($draws as $d => $draw) {
            $out['draws'][$d] = [
                'created_at' => $draw->created_at,
                'winner_id' => $draw->user()->first()->id,
                'email' => $draw->user()->first()->email,
                'draw_id' => $draw->id,
                'item_name' => $draw->draw()->first()->product()->first()->name,
                'item_image' => 'product-imgs/' . $draw->draw()->first()->product()->first()->imgs()->first()->img
            ];
        }

        return view('layouts.users_draw_history')->with('draws', $out);
    }


    public function export_draw_histories()
    {
        $out = array();
        $draws = DrawUser::orderBy('id', 'desc')->get();
        foreach ($draws as $d => $draw) {
            $out[] = [
                'DATE' => $draw->created_at,
                'EMAIL' => $draw->user()->first()->email,
                'DRAW_ID' => 'D' . str_pad($draw->id, 6, '0', STR_PAD_LEFT),
                'PRODUCT_NAME' => $draw->draw()->first()->product()->first()->name
            ];
        }
        if ($out) {
            Excel::create('exported_draws', function ($excel) use ($out) {
                $excel->sheet('exported_draws', function ($sheet) use ($out) {
                    $sheet->fromArray($out);
                });
            })->export('xls');
        }
    }

    public function draw_winner_histories()
    {
        $draws = DrawPlan::orderBy('id', 'desc')->whereIn('status', ['2', '3', '4'])
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
        $out['users_draw_total'] = DrawPlan::whereIn('status', ['2', '3', '4'])
                                            ->whereNotNull('winner_id')
                                            ->count();
        $out['users_draw_history'] = $draws->links();
        foreach ($draws as $d => $draw) {
            $draw_winner = $draw->winner()->first();
            if ($draw_winner) {
                $draw_winner_id = $draw_winner->id;
                $draw_winner_email = $draw_winner->email;
            } else {
                $draw_winner_id = 0;
                $draw_winner_email = '';
            }
            $out['draws'][$d] = [
                'created_at' => $draw->updated_at,
                'winner_id' => $draw_winner_id,
                'email' => $draw_winner_email,
                'draw_id' => $draw->id,
                'item_name' => $draw->product()->first()->name,
                'product_id' => $draw->product()->first()->id,
                'item_status' => $draw->status,
                'item_image' => 'product-imgs/' . $draw->product()->first()->imgs()->first()->img
            ];
        }

        return view('layouts.users_draw_winner_history')->with('draws', $out);
    }


    public function export_draw_winner_histories()
    {
        $out = array();
        $draws = DrawPlan::orderBy('id', 'desc')->whereIn('status', ['2', '3', '4'])
                                                ->whereNotNull('winner_id')
                                                ->get();
        foreach ($draws as $d => $draw) {
            $draw_winner = $draw->winner()->first();
            if ($draw_winner) {
                $draw_winner_id = $draw_winner->id;
                $draw_winner_email = $draw_winner->email;
            } else {
                $draw_winner_id = 0;
                $draw_winner_email = '';
            }
            if ($draw->status == 0) {
                $remarks = 'UNKNOWN';
            } else {
                if ($draw->status == 1) {
                    $remarks = 'Active';
                } else {
                    if ($draw->status == 2) {
                        $remarks = 'Completed';
                    } else {
                        if ($draw->status == 3) {
                            $remarks = 'For Delivery';
                        } else {
                            if ($draw->status == 4) {
                                $remarks = 'Delivered';
                            } else {
                                $remarks = 'UNKNOWN';
                            }
                        }
                    }
                }
            }
            $out[] = [
                'DATE' => $draw->updated_at,
                'EMAIL' => $draw_winner_email,
                'DRAW_ID' => 'D' . str_pad($draw->id, 6, '0', STR_PAD_LEFT),
                'PRODUCT_NAME' => $draw->product()->first()->name,
                'REMARKS' => $remarks
            ];
        }
        if ($out) {
            Excel::create('exported_draw_winners', function ($excel) use ($out) {
                $excel->sheet('exported_draw_winners', function ($sheet) use ($out) {
                    $sheet->fromArray($out);
                });
            })->export('xls');
        }
    }

    public function draw_winner_history(Request $request)
    {
        $draws = DrawPlan::orderBy('id', 'desc')->whereIn('status', ['2', '3', '4'])
            ->where('winner_id', session('user_id'))
            ->paginate(25);
        $out['users_draw_total'] = DrawPlan::whereIn('status', ['2', '3', '4'])
            ->where('winner_id', session('user_id'))
            ->count();
        $out['users_draw_history'] = $draws->links();
        foreach ($draws as $d => $draw) {
            $out['draws'][$d] = [
                'created_at' => $draw->updated_at,
                'draw_id' => $draw->id,
                'product_id' => $draw->product()->first()->id,
                'item_name' => $draw->product()->first()->name,
                'item_status' => $draw->status,
                'item_image' => 'product-imgs/' . $draw->product()->first()->imgs()->first()->img
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

        return view('layouts.user_draw_winner_history')->with('draws', $out)
            ->with('message', $message);
    }

    public function draw_winner_action(Request $request)
    {
        $item_remarks = '';
        $draw = DrawPlan::where('id', $request->a)
            ->first();
        $draw_winner = $draw->winner()->first();
        if ($draw_winner) {
            $draw_winner_email = $draw_winner->email;
            $draw_winner_address = $draw_winner->address;
            $draw_winner = $draw_winner->first_name . ' ' . $draw_winner->last_name;
        } else {
            $draw_winner_email = '';
            $draw_winner_address = '';
            $draw_winner = '';
        }
        if ($draw->status == 2) {
            $item_remarks = 'PENDING PAYMENT';
        } elseif ($draw->status == 3) {
            $item_remarks = 'FOR DELIVERY';
        } elseif ($draw->status == 4) {
            $item_remarks = 'DELIVERED';
        }
        $draw = [
            'created_at' => $draw->updated_at,
            'email' => $draw_winner_email,
            'address' => $draw_winner_address,
            'full_name' => $draw_winner,
            'draw_id' => 'D' . str_pad($draw->id, 6, '0', STR_PAD_LEFT),
            'item_name' => $draw->product()->first()->name,
            'item_status' => $item_remarks,
            'item_image' => asset('product-imgs/' . $draw->product()->first()->imgs()->first()->img)
        ];
        $out = [
            1,
            'Luxky Draw Winner of ' . $draw['item_name'],
            '<div class="row">
        <div class="col-sm-3">
          <div class="form-group">
            <label class="control-label">Draw ID</label>
            <div class="form-control"> ' . $draw['draw_id'] . ' </div>
          </div>
          <img src="' . $draw['item_image'] . '" />
        </div>
        <div class="col-sm-9">
          <div class="form-group">
            <label class="control-label">Email</label>
            <div class="form-control"> ' . $draw['email'] . ' </div>
          </div>
          <div class="form-group">
            <label class="control-label">Name</label>
            <div class="form-control"> ' . $draw['full_name'] . ' </div>
          </div>
          <div class="form-group">
              <label class="control-label">Delivery Address</label>
              <div class="form-control"> ' . $draw['address'] . ' </div>
          </div>
          <div class="form-group">
              <label class="control-label">Remarks</label>
              <div class="form-control"> ' . $draw['item_status'] . ' </div>
          </div>
        </div>
      </div>
      '
        ];

        return $out;
    }

    public function draw_winner_action_delivered(Request $request)
    {
        $draw = DrawPlan::where('id', $request->a)
            ->first();
        if ($draw) {
            if ($draw->status == 3) {
                $draw->status = 4;
                $draw->save();

                return [1, 'Delivery', 'Item was marked for delivery', 'success'];
            } elseif ($draw->status == 4) {
                return [1, 'Delivery', 'Item was already marked for delivery', 'success'];
            } else {
                return [0, 'Delivery', 'Item was not marked for delivery', 'error'];
            }
        } else {
            return [0, 'Delivery', 'Item was not marked for delivery', 'error'];
        }
    }

}
