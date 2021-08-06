<?php

namespace App\Http\Controllers;

use Mail;
use Auth;
use Hash;
use Carbon\Carbon;

use App\Jobs\SendEmail;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\AdminConfig;
use App\UserPurchase;

use App\Http\Controllers\Auth\AuthController;

class UserLoginController extends Controller
{
    public function index()
    {
        return view('layouts.user_login');
    }

    public function update_user(Request $request)
    {
        if ($request->u) {
            $user = User::where('id', $request->u)->first();
        } else {
            $user = User::where('id', session('user_id'))->first();
        }

        return view('layouts.user_account')->with('user', $user)->with('birthday',
            Carbon::parse($user->birthday)->toFormattedDateString());
    }

    public function register(Request $request)
    {
        /*
        string('first_name',255);         = f
        string('last_name',255);          = l
        unsignedInteger('gender');        = g
        timestamp('birthday');            = b
        string('email')->unique();        = e
        string('mobile')->unique();       = m
        string('password_1', 60);         = p1
        ('password_2');                   = p2
        */
        $config = AdminConfig::where('id', 1)->first();
        $f = trim($request->f);
        $l = trim($request->l);
        $n = trim($request->n);
        $e = trim($request->e);
        if ($request->g) {
            $g = 1;
        } else {
            $g = 0;
        }
        $b = $request->b;
        $p1 = trim($request->p1);
        $p2 = trim($request->p2);
        $r = trim($request->r);
        $s = trim($request->s);
        $code = mt_rand(1000, 9999);

        if ($f == '') {
            return [0, 'First name cannot be blank'];
        }
        if ($l == '') {
            return [0, 'Last name cannot be blank'];
        }
        if ($n == '') {
            return [0, 'Nick name cannot be blank'];
        }
        if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
            return [0, 'Invalid email format'];
        }
        if (!$b) {
            return [0, 'Birthday cannot be blank'];
        }
        if (time() < strtotime('+18 years', strtotime($b))) {
            return [0, 'Member must be 18 years old or above'];
        }
        if ($p1 == '') {
            return [0, 'Password cannot be blank'];
        }
        if ($p1 != $p2) {
            return [0, 'Password does not match'];
        }

        if (User::where('nick_name', '=', $n)->where('verified', '=', 1)->exists()) {
            return [0, 'Nick name already exist'];
        }

        if (User::where('email', '=', $e)->where('verified', '=', 1)->exists()) {
            return [0, 'Email address already registered'];
        }

        $m = trim($request->m);
        preg_match('/^[689]\d{7}$/D', $m, $sg_mobile);
        if (!$sg_mobile) {
            return [0, 'Mobile number is invalid'];
        }

        $m = '65' . $m;

        if (User::where('mobile', '=', $m)->where('verified', '=', 1)->exists()) {
            return [0, 'Mobile number already registered'];
        }

        if ($r) {
            if (!User::where('nick_name', '=', $r)->where('verified', '=', 1)->exists()) {
                return [0, 'Referrer Nick Name not found'];
            }
        }

        // if (!($this::send_sms($m, $code))) {
        //   return [0, 'Failed to send verification code to mobile number'];
        // }

        $code = 1234; // <! REMOVE AFTER TESTING !>

        if (User::where('email', '=', $e)->where('verified', '=', 0)->exists()) {
            $user = User::where('email', $e)->first();
            if ($user) {
                $user->first_name = $f;
                $user->last_name = $l;
                $user->nick_name = $n;
                $user->email = $e;
                $user->mobile = $m;
                $user->gender = $g;
                $user->birthday = $b;
                $user->password = bcrypt($p1);
                $user->tokens = $config->register_tokens;
                $user->send_promo = $s;
                $user->verification_code = $code;
                $user->save();
            }
        } else {
            $data = [
                'first_name' => $f,
                'last_name' => $l,
                'nick_name' => $n,
                'email' => $e,
                'mobile' => $m,
                'gender' => $g,
                'birthday' => $b,
                'password' => $p1,
                'tokens' => $config->register_tokens,
                'send_promo' => $s,
                'verification_code' => $code
            ];
            $auth = new AuthController;
            $user = $auth->create($data);
        }
        $this::send_mail($user);

        return [1, 'New User Registration', 'Check your email to verify your account'];

    }

    public function update_user_password(Request $request)
    {
        $p1 = trim($request->p1);
        $p2 = trim($request->p2);
        $p3 = trim($request->p3);
        if ($p1 == '') {
            return [0, 'Password cannot be blank'];
        }
        if ($p2 != $p3) {
            return [0, 'New password does not match'];
        }
        if ($p2 == $p3) {
            if (Auth::attempt(['email' => session('email'), 'password' => $p1])) {
                $user = User::where('id', session('user_id'))->first();
                $user->password = bcrypt($p2);
                $user->save();

                return [
                    1,
                    'User Account Updated',
                    'Your account password was successfully updated. Please login again'
                ];
            } else {
                return [0, 'Current password is invalid'];
            }
        }
    }

    public function update_user_address(Request $request)
    {
        $a = trim($request->a);
        if ($a == '') {
            return [0, 'Delivery address cannot be blank'];
        }
        $user = User::where('id', session('user_id'))->first();
        $user->address = $a;
        $user->save();

        return [1, 'User Account Updated', 'Your delivery address was successfully updated!'];
    }

    public function login(Request $request)
    {
        /*
        string('email')->unique();      = e
        string('password', 60);         = p
        */
        $e = trim($request->e);
        $p = trim($request->p);
        if (Auth::attempt(['email' => $e, 'password' => $p, 'enabled' => 1])) {
            $user = User::where('email', $e)->first();
            $request->session()->put('user_id', $user->id);
            $request->session()->put('email', $user->email);
            Auth::loginUsingId($request->session()->get('user_id'));

            return [1, $user->id];
        } else {
            return [0, 'Invalid login'];
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();

        return redirect()->intended('/');
    }

    public function send_sms($mobile, $code)
    {
      if (config('services.hoseh_services.send_sms')) {
        $config = AdminConfig::where('id', 1)->first();
        $data_to_post = array();
        $data_to_post['un'] = $config->sms_user_name;
        $data_to_post['pwd'] = $config->sms_user_password;
        $data_to_post['dstno'] = $mobile;
        $data_to_post['msg'] = 'Your%20hoseh.com%20user%20registration%20verification%20code%20is%20' . $code;
        $data_to_post['type'] = '1';
        $url = "http://isms.com.my/isms_send.php";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, sizeof($data_to_post));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_to_post);
        $rx = curl_exec($curl);
        curl_close($curl);
        if ($rx == '2000 = SUCCESS' || $rx == '') {
            return 1;
        } else {
            return 0;
        }
      }
      else {
        return 1;
      }
    }

    public function send_mail($user)
    {
        $email = [
            'type' => 'registration',
            'user' => $user,
            'template' => 'emails.registration',
            'from' => 'Hoseh Registraion',
            'subject' => 'Welcome To hoseh.com - Thanks for your registration'
        ];
        $this->dispatch(new SendEmail($email));
    }

    public function verifiy_user(Request $request)
    {
        $user = User::where('email', $request->e)->first();
        if ($user) {
            if ($user->verification_code == $request->v) {
                $user->enabled = 1;
                $user->verified = 1;
                if ($request->r) {
                  $referrer = User::where('nick_name', $request->r)->first();
                  if ($referrer) {
                    $user->referral_by = $referrer->id;
                  }
                }
                $user->save();
                $config = AdminConfig::where('id', 1)->first();
                $user_purchase = new UserPurchase;
                $user_purchase->user_id = $user->id;
                $user_purchase->invoice_id = uniqid();
                $user_purchase->amount = 0;
                $user_purchase->desc = $config->register_tokens . ' bonus registration token(s) from ' . 'hoseh.com';
                $user_purchase->save();

                return [1, 'Verified', 'User was verified successfully. You may now log in!'];
            } else {
                return [0, 'Verification code was not correct!'];
            }
        } else {
            return [0, 'User does not exist!'];
        }
    }

    public function forgot_password()
    {
        return view('auth.password');
    }

}
