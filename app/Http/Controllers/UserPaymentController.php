<?php

namespace App\Http\Controllers;

use Mail;
use Excel;
use PayPal;
use App\User;
use Redirect;
use App\Token;
use App\UserPurchase;
use App\BidPlan;
use App\DrawPlan;
use App\BidPurchase;
use App\DrawPurchase;
use Illuminate\Http\Request;
use App\Jobs\SendEmail;
use App\AdminConfig;


use App\Http\Requests;

class UserPaymentController extends Controller
{
    private $_apiContext;

    public function __construct()
    {
        $config = AdminConfig::where('id', 1)->first();
        $this->_apiContext = PayPal::ApiContext(
            $config->paypal_paypal_client_id,
            $config->paypal_secret);

        $this->_apiContext->setConfig(array(
            'mode' => $config->paypal_mode,
            'service.EndPoint' => $config->paypal_end_point,
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));
    }

    public function get_buy_token_checkout(Request $request)
    {
        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');

        $item = PayPal::Item();

        $token = Token::where('index', $request->t)->first();

        if ($token) {
            $selected_token = [
                'count' => $token->count,
                'price' => $token->price,
                'extra' => $token->extra_tokens
            ];
        } else {
            $selected_token = [
                'count' => 0,
                'price' => 0
            ];
        }

        $item_name = 'Lucky Pack ' . $selected_token['count'];
        $item_price = $selected_token['price'];
        $item_count = $selected_token['count'] + $selected_token['extra'];

        $request->session()->put('token_pack', $item_name);
        $request->session()->put('invoice_id', uniqid());
        $request->session()->put('token_count', $item_count);
        $request->session()->put('payment_amount', $item_price);

        $item->setName($item_name)
            ->setDescription($item_name)
            ->setCurrency('SGD')
            ->setQuantity(1)
            ->setPrice($item_price);

        $itemList = PayPal::ItemList();
        $itemList->addItem($item);

        $details = PayPal::Details();
        $details->setShipping(0)
            ->setTax(0.0)
            ->setSubTotal($item_price);

        $amount = PayPal:: Amount();
        $amount->setCurrency('SGD')
            ->setTotal($item_price)
            ->setDetails($details);

        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setInvoiceNumber($request->session()->get('invoice_id'))
            ->setDescription($item_name);

        $redirectUrls = PayPal:: RedirectUrls();
        $redirectUrls->setReturnUrl(action('UserPaymentController@get_buy_token_done'));
        $redirectUrls->setCancelUrl(action('UserPaymentController@get_buy_token_cancel'));

        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;

        return Redirect::to($redirectUrl);
    }

    public function get_buy_token_done(Request $request)
    {
        $id = $request->get('paymentId');
        $payer_id = $request->get('PayerID');
        $token_pack = $request->session()->get('token_pack');
        $token_count = $request->session()->get('token_count');
        $payment_amount = $request->session()->get('payment_amount');
        $invoice_id = $request->session()->get('invoice_id');

        $payment = PayPal::getById($id, $this->_apiContext);

        $paymentExecution = PayPal::PaymentExecution();

        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        // Clear the shopping cart, write to database, send notifications, etc.
        if ($executePayment->state == 'approved') {
            $user_purchase = new UserPurchase;
            $user_purchase->user_id = session('user_id');
            $user_purchase->invoice_id = $invoice_id;
            $user_purchase->amount = $payment_amount;
            $user_purchase->desc = 'Thank you for purchasing Token Pack ' . $token_pack;
            $user_purchase->save();

            $user = User::where('id', session('user_id'))->first();
            $user->tokens = $user->tokens + $token_count;
            $addresses = json_decode($executePayment->payer->payer_info->shipping_address);
            $user->address = '';
            foreach ($addresses as $property => $value) {
                $address[$property] = $value;
                if ($property != 'recipient_name') {
                    $user->address .= $value . '
';
                }
            }

            if (config('services.hoseh_services.enable_referral')) {
                if ($user->referral_by && !$user->referral_claimed) {
                    $referrer = User::where('id', $user->referral_by)->first();
                    if ($referrer) {
                        $config = AdminConfig::where('id', 1)->first();
                        $referrer->tokens += $config->refer_tokens;
                        $referrer->save();
                        $user_purchase = new UserPurchase;
                        $user_purchase->user_id = $referrer->id;
                        $user_purchase->invoice_id = uniqid();
                        $user_purchase->amount = 0;
                        $user_purchase->desc = $config->refer_tokens . ' bonus referral token(s) from ' . $user->nick_name;
                        $user_purchase->save();
                        $user->referral_claimed = 1;
                    }
                }
            }

            $user->save();

            $purchase = [
                'invoice_id' => $invoice_id,
                'token_pack' => $token_pack,
                'user' => $user
            ];

            $this::send_email_token_purchased($purchase);

            return Redirect::to(action('UserPaymentController@selectCredit') . '?success=true&token_count=' . $token_count);
            // return view('layouts.purchase_credits_prices')->with('token_count', $token_count)
            //                                               ->with('user_tokens', $user->tokens)
            //                                               ->with('tokens', $this::getTokens());
        } else {
            return Redirect::to(action('UserPaymentController@selectCredit') . '?success=false');
            // return view('layouts.purchase_credits_prices')->with('tokens', $this::getTokens());
        }
    }

    public function get_buy_token_cancel()
    {
        // Curse and humiliate the user for cancelling this most sacred payment (yours)
        return view('layouts.purchase_credits_prices')->with('tokens', $this::getTokens());
    }

    public function getTokens()
    {
        $tokens = Token::all();
        foreach ($tokens as $token) {
            $out[$token->index]['count'] = $token->count;
            $out[$token->index]['price'] = $token->price;
            $out[$token->index]['extra_tokens'] = $token->extra_tokens;
        }

        return $out;
    }

    public function selectCredit(Request $request)
    {
        if ($request->success === 'true') {
            return view('layouts.purchase_credits_prices')->with('tokens', $this::getTokens())
                ->with('token_count', $request->token_count);
        } else {
            if ($request->success === 'false') {
                return view('layouts.purchase_credits_prices')->with('tokens', $this::getTokens())
                    ->with('error_message', 'Transaction Failed. Please try again later.');
            } else {
                return view('layouts.purchase_credits_prices')->with('tokens', $this::getTokens());
            }
        }
    }

    public function updateCredit(Request $request)
    {
        $token = Token::where('index', $request->i)->first();
        if ($token) {
            $token->count = $request->c;
            $token->price = $request->p;
            if ($token->save()) {
                return [1, 'Token Pack ' . $token->count . ' saved successfully!', 'success'];
            } else {
                return [0, 'Token Pack ' . $token->count . ' was not saved!', 'warning'];
            }
        }
    }

    public function send_email_token_purchased($purchase)
    {
        $email = [
            'type' => 'purchase',
            'purchase' => $purchase,
            'template' => 'emails.purchase',
            'from' => 'Hoseh Purchases',
            'subject' => $purchase['invoice_id'] . ' - ' . $purchase['token_pack'] . ' from hoseh.com - Thanks for your purchase'
        ];
        $this->dispatch(new SendEmail($email));
    }

    public function payment_history()
    {
        $purchases = UserPurchase::where('user_id', session('user_id'))->orderBy('created_at', 'desc')->paginate(25);

        return view('layouts.user_payment_history', compact('purchases'));
    }

    public function payment_histories()
    {
        $purchases = UserPurchase::orderBy('created_at', 'desc')->paginate(25);
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
        $out['users_payment_total'] = UserPurchase::sum('amount');
        $out['users_payment_history'] = $purchases->links();
        foreach ($purchases as $p => $purchase) {
            $out['purchases'][$p] = [
                'created_at' => $purchase->created_at,
                'user_id' => $purchase->user()->first()->id,
                'email' => $purchase->user()->first()->email,
                'invoice_id' => $purchase->invoice_id,
                'amount' => $purchase->amount,
                'desc' => $purchase->desc
            ];
        }

        return view('layouts.users_payment_history')->with('purchases', $out);
    }

    public function export_payment_histories()
    {
        $out = array();
        $purchases = UserPurchase::orderBy('created_at', 'desc')->get();
        foreach ($purchases as $p => $purchase) {
            $out[] = [
                'DATE' => $purchase->created_at,
                'EMAIL' => $purchase->user()->first()->email,
                'INVOICE_ID' => $purchase->invoice_id,
                'AMOUNT' => $purchase->amount,
                'DESCRIPTION' => $purchase->desc
            ];
        }
        if ($out) {
            Excel::create('exported_payments', function ($excel) use ($out) {
                $excel->sheet('exported_payments', function ($sheet) use ($out) {
                    $sheet->fromArray($out);
                });
            })->export('xls');
        }
    }

    public function get_claim_auction_checkout(Request $request)
    {
        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');

        $item = PayPal::Item();

        $purchase = BidPlan::where('id', $request->b)
            ->where('winner_id', session('user_id'))
            ->first();

        if ($purchase) {
            $selected_purchase = [
                'id' => $purchase->id,
                'name' => 'A' . str_pad($purchase->id, 6, '0',
                        STR_PAD_LEFT) . ': ' . $purchase->product()->first()->name,
                'price' => $purchase->increment * $purchase->entries,
                'shipping' => $purchase->product()->first()->delivery_charge
            ];
        } else {
            return redirect()->intended(action('BidUserController@bid_winner_history'));
        }

        $bid_id = $selected_purchase['id'];
        $item_name = $selected_purchase['name'];
        $item_price = $selected_purchase['price'];
        $item_shipping = $selected_purchase['shipping'];
        $item_total = $item_price + $item_shipping;

        $request->session()->put('bid_id', $bid_id);
        $request->session()->put('invoice_id', uniqid());
        $request->session()->put('payment_amount', $item_total);

        $item->setName($item_name)
            ->setDescription('Won item - ' . $item_name)
            ->setCurrency('SGD')
            ->setQuantity(1)
            ->setPrice($item_price);

        $itemList = PayPal::ItemList();
        $itemList->addItem($item);

        $details = PayPal::Details();
        $details->setShipping($item_shipping)
            ->setTax(0.0)
            ->setSubTotal($item_price);

        $amount = PayPal:: Amount();
        $amount->setCurrency('SGD')
            ->setTotal($item_total)
            ->setDetails($details);

        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setInvoiceNumber($request->session()->get('invoice_id'))
            ->setDescription($item_name);

        $redirectUrls = PayPal:: RedirectUrls();
        $redirectUrls->setReturnUrl(action('UserPaymentController@get_claim_auction_done'));
        $redirectUrls->setCancelUrl(action('UserPaymentController@get_claim_auction_cancel'));

        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;

        return Redirect::to($redirectUrl);
    }

    public function get_claim_auction_done(Request $request)
    {
        $id = $request->get('paymentId');
        $payer_id = $request->get('PayerID');
        $bid_id = $request->session()->get('bid_id');
        $invoice_id = $request->session()->get('invoice_id');
        $payment_amount = $request->session()->get('payment_amount');

        $payment = PayPal::getById($id, $this->_apiContext);

        $paymentExecution = PayPal::PaymentExecution();

        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        // Clear the shopping cart, write to database, send notifications, etc.
        if ($executePayment->state == 'approved') {
            $bid_plan = BidPlan::where('id', $bid_id)->first();
            $user = User::where('id', session('user_id'))->first();
            $user_purchase = new UserPurchase;
            $user_purchase->user_id = session('user_id');
            $user_purchase->invoice_id = $invoice_id;
            $user_purchase->amount = $payment_amount;
            $user_purchase->desc = 'A' . str_pad($bid_plan->id, 6, '0',
                    STR_PAD_LEFT) . ': ' . $bid_plan->product()->first()->name;
            $user_purchase->save();

            $bid_plan->status = 3;
            $bid_plan->save();
            $address = array();
            $delivery_address = $executePayment->payer->payer_info->shipping_address;
            $addresses = json_decode($executePayment->payer->payer_info->shipping_address);
            $user->address = '';
            foreach ($addresses as $property => $value) {
                $address[$property] = $value;
                if ($property != 'recipient_name') {
                    $user->address .= $value . '
 ';
                }
            }
            $user->save();
            $purchase = [
                'invoice_id' => $invoice_id,
                'item_name' => $user_purchase->desc,
                'address' => $user->address,
                'user' => $user
            ];
            $this::send_email_auction_purchased($purchase);

            return redirect()->intended(action('BidUserController@bid_winner_history') . '?success=true');
        } else {
            return redirect()->intended(action('BidUserController@bid_winner_history') . '?success=false');
        }
    }

    public function get_claim_auction_cancel()
    {
        // Curse and humiliate the user for cancelling this most sacred payment (yours)
        return redirect()->intended(action('BidUserController@bid_winner_history'));
    }

    public function send_email_auction_purchased($purchase)
    {
        $email = [
            'type' => 'purchase',
            'purchase' => $purchase,
            'template' => 'emails.purchase_bid',
            'from' => 'Hoseh Purchases',
            'subject' => $purchase['invoice_id'] . ' - ' . $purchase['item_name'] . ' from hoseh.com - Thanks for your purchase'
        ];
        $this->dispatch(new SendEmail($email));
    }

    public function get_claim_draw_checkout(Request $request)
    {
        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');

        $item = PayPal::Item();

        $purchase = DrawPlan::where('id', $request->d)
            ->where('winner_id', session('user_id'))
            ->first();

        if ($purchase) {
            $selected_purchase = [
                'id' => $purchase->id,
                'name' => 'D' . str_pad($purchase->id, 6, '0',
                        STR_PAD_LEFT) . ': ' . $purchase->product()->first()->name,
                'price' => 0,
                'shipping' => $purchase->product()->first()->delivery_charge
            ];
        } else {
            return redirect()->intended(action('DrawUserController@draw_winner_history'));
        }

        $draw_id = $selected_purchase['id'];
        $item_name = $selected_purchase['name'];
        $item_price = $selected_purchase['price'];
        $item_shipping = $selected_purchase['shipping'];
        $item_total = $item_price + $item_shipping;

        $request->session()->put('draw_id', $draw_id);
        $request->session()->put('invoice_id', uniqid());
        $request->session()->put('payment_amount', $item_total);

        $item->setName($item_name)
            ->setDescription('Won item - ' . $item_name)
            ->setCurrency('SGD')
            ->setQuantity(1)
            ->setPrice($item_price);

        $itemList = PayPal::ItemList();
        $itemList->addItem($item);

        $details = PayPal::Details();
        $details->setShipping($item_shipping)
            ->setTax(0.0)
            ->setSubTotal($item_price);

        $amount = PayPal:: Amount();
        $amount->setCurrency('SGD')
            ->setTotal($item_total)
            ->setDetails($details);

        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setInvoiceNumber($request->session()->get('invoice_id'))
            ->setDescription($item_name);

        $redirectUrls = PayPal:: RedirectUrls();
        $redirectUrls->setReturnUrl(action('UserPaymentController@get_claim_draw_done'));
        $redirectUrls->setCancelUrl(action('UserPaymentController@get_claim_draw_cancel'));

        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;

        return Redirect::to($redirectUrl);
    }

    public function get_claim_draw_done(Request $request)
    {
        $id = $request->get('paymentId');
        $payer_id = $request->get('PayerID');
        $draw_id = $request->session()->get('draw_id');
        $invoice_id = $request->session()->get('invoice_id');
        $payment_amount = $request->session()->get('payment_amount');

        $payment = PayPal::getById($id, $this->_apiContext);

        $paymentExecution = PayPal::PaymentExecution();

        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        // Clear the shopping cart, write to database, send notifications, etc.
        if ($executePayment->state == 'approved') {
            $draw_plan = DrawPlan::where('id', $draw_id)->first();
            $user = User::where('id', session('user_id'))->first();
            $user_purchase = new UserPurchase;
            $user_purchase->user_id = session('user_id');
            $user_purchase->invoice_id = $invoice_id;
            $user_purchase->amount = $payment_amount;
            $user_purchase->desc = 'D' . str_pad($draw_plan->id, 6, '0',
                    STR_PAD_LEFT) . ': ' . $draw_plan->product()->first()->name;
            $user_purchase->save();

            $draw_plan->status = 3;
            $draw_plan->save();
            $address = array();
            $delivery_address = $executePayment->payer->payer_info->shipping_address;
            $addresses = json_decode($executePayment->payer->payer_info->shipping_address);
            $user->address = '';
            foreach ($addresses as $property => $value) {
                $address[$property] = $value;
                if ($property != 'recipient_name') {
                    $user->address .= $value . '
';
                }
            }
            $user->save();
            $purchase = [
                'invoice_id' => $invoice_id,
                'item_name' => $user_purchase->desc,
                'address' => $user->address,
                'user' => $user
            ];
            $this::send_email_draw_purchased($purchase);

            return redirect()->intended(action('DrawUserController@draw_winner_history') . '?success=true');
        } else {
            return redirect()->intended(action('DrawUserController@draw_winner_history') . '?success=false');
        }
    }

    public function get_claim_draw_cancel()
    {
        // Curse and humiliate the user for cancelling this most sacred payment (yours)
        return redirect()->intended(action('DrawUserController@draw_winner_history'));
    }

    public function send_email_draw_purchased($purchase)
    {
        $email = [
            'type' => 'purchase',
            'purchase' => $purchase,
            'template' => 'emails.purchase_draw',
            'from' => 'Hoseh Purchases',
            'subject' => $purchase['invoice_id'] . ' - ' . $purchase['item_name'] . ' from hoseh.com - Thanks for your purchase'
        ];
        $this->dispatch(new SendEmail($email));
    }


    public function get_claim_buy_checkout(Request $request)
    {
        $transaction_type = '';
        $purchase = '';
        $back = '';
        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');

        $item = PayPal::Item();

        if ($request->t == 'bid') {
            $transaction_prefix = 'A';
            $back = '?p=' . $request->p . '&m=hb&b=' . $request->b;
            $purchase = BidPlan::where('id', $request->b)
                ->first();
            $transaction_type = 'bid';
        } else {
            if ($request->t == 'draw') {
                $transaction_prefix = 'D';
                $back = '?p=' . $request->p . '&m=h&d=' . $request->d;
                $purchase = DrawPlan::where('id', $request->d)
                    ->first();
                $transaction_type = 'draw';
            }
        }
        if ($purchase) {
            $selected_purchase = [
                'id' => $purchase->id,
                'name' => $purchase->product()->first()->name,
                'price' => $purchase->product()->first()->price,
                'shipping' => $purchase->product()->first()->delivery_charge
            ];
        } else {
            return redirect()->intended(action('ProductDetailController@show') . $back);
        }

        $transaction_id = $selected_purchase['id'];
        $item_name = $selected_purchase['name'];
        $item_price = $selected_purchase['price'];
        $item_shipping = $selected_purchase['shipping'];
        $item_total = $item_price + $item_shipping;

        $request->session()->put('transaction_type', $transaction_type);
        $request->session()->put('transaction_id', $transaction_id);
        $request->session()->put('invoice_id', uniqid());
        $request->session()->put('payment_amount', $item_total);
        $request->session()->put('back', $back);

        $item->setName($item_name)
            ->setDescription('Buy item - ' . $item_name)
            ->setCurrency('SGD')
            ->setQuantity(1)
            ->setPrice($item_price);

        $itemList = PayPal::ItemList();
        $itemList->addItem($item);

        $details = PayPal::Details();
        $details->setShipping($item_shipping)
            ->setTax(0.0)
            ->setSubTotal($item_price);

        $amount = PayPal:: Amount();
        $amount->setCurrency('SGD')
            ->setTotal($item_total)
            ->setDetails($details);

        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setInvoiceNumber(session('invoice_id'))
            ->setDescription($item_name);

        $redirectUrls = PayPal:: RedirectUrls();
        $redirectUrls->setReturnUrl(action('UserPaymentController@get_claim_buy_done'));
        $redirectUrls->setCancelUrl(action('UserPaymentController@get_claim_buy_cancel'));

        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;

        return Redirect::to($redirectUrl);
    }

    public function get_claim_buy_done(Request $request)
    {
        $id = $request->get('paymentId');
        $payer_id = $request->get('PayerID');
        $user_purchase = '';
        $transaction_plan = '';

        $transaction_type = $request->session()->get('transaction_type');
        $transaction_id = $request->session()->get('transaction_id');
        $invoice_id = $request->session()->get('invoice_id');
        $payment_amount = $request->session()->get('payment_amount');
        $back = $request->session()->get('back');

        $payment = PayPal::getById($id, $this->_apiContext);

        $paymentExecution = PayPal::PaymentExecution();

        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        // Clear the shopping cart, write to database, send notifications, etc.
        if ($executePayment->state == 'approved') {

            $user = User::where('id', session('user_id'))->first();
            if ($transaction_type == 'bid') {
                $transaction_prefix = 'A';
                $transaction_plan = BidPlan::where('id', $transaction_id)->first();
                $user_purchase = new BidPurchase;
                $user_purchase->bid_id = $transaction_id;
            } else {
                if ($transaction_type == 'draw') {
                    $transaction_prefix = 'D';
                    $transaction_plan = DrawPlan::where('id', $transaction_id)->first();
                    $user_purchase = new DrawPurchase;
                    $user_purchase->draw_id = $transaction_id;
                }
            }
            $user_purchase->user_id = session('user_id');
            $user_purchase->invoice_id = $invoice_id;
            $user_purchase->price = $payment_amount;
            $return_tokens = $transaction_plan->return_tokens(session('user_id'))->count();
            $user_purchase->entries = $return_tokens;
            $user_purchase->desc = $transaction_plan->product()->first()->name;
            $user_purchase->save();
            $user_purchase = new UserPurchase;
            $user_purchase->user_id = session('user_id');
            $user_purchase->invoice_id = $invoice_id;
            $user_purchase->amount = $payment_amount;
            $user_purchase->desc = $transaction_plan->product()->first()->name;
            $user_purchase->save();
            $address = array();
            $delivery_address = $executePayment->payer->payer_info->shipping_address;
            $addresses = json_decode($executePayment->payer->payer_info->shipping_address);
            $user->tokens += $return_tokens;
            $user->address = '';
            foreach ($addresses as $property => $value) {
                $address[$property] = $value;
                if ($property != 'recipient_name') {
                    $user->address .= $value . '
';
                }
            }
            $user->save();
            $purchase = [
                'invoice_id' => $invoice_id,
                'item_name' => $user_purchase->desc,
                'address' => $user->address,
                'user' => $user
            ];
            $this::send_email_buy_purchased($purchase);

            return redirect()->intended(action('ProductDetailController@show') . $back . '&success=true');
        } else {
            return redirect()->intended(action('ProductDetailController@show') . $back . '&success=false');
        }
    }

    public function get_claim_buy_cancel(Request $request)
    {
        $back = $request->session()->get('back');

        // Curse and humiliate the user for cancelling this most sacred payment (yours)
        return redirect()->intended(action('ProductDetailController@show') . $back);
    }

    public function send_email_buy_purchased($purchase)
    {
        $email = [
            'type' => 'purchase',
            'purchase' => $purchase,
            'template' => 'emails.purchase_bid',
            'from' => 'Hoseh Purchases',
            'subject' => $purchase['invoice_id'] . ' - ' . $purchase['item_name'] . ' from hoseh.com - Thanks for your purchase'
        ];
        $this->dispatch(new SendEmail($email));
    }

    public function update_user_token(Request $request)
    {
      $user_id = $request->u;
      $new_token = $request->t;
      $invoice_id = uniqid();

      if (!$new_token) {
        $new_token = 0;
      }

      $user = User::where('id', $user_id)->first();
      $user->tokens = $new_token;
      $user->save();

      $user_purchase = new UserPurchase;
      $user_purchase->user_id = $user_id;
      $user_purchase->invoice_id = $invoice_id;
      $user_purchase->amount = 0;
      $user_purchase->desc = 'Token Updated by Hoseh Admin. Token is now ' . $new_token;
      $user_purchase->save();

      $purchase = [
          'invoice_id' => $invoice_id,
          'token_pack' => 'Token Updated by Hoseh Admin. Token is now ' . $new_token,
          'user' => $user
      ];

      $this::send_email_token_purchased($purchase);

      return ['1', 'User Token Updated', $user->email . ' token was updated to ' . $new_token];
    }

}
