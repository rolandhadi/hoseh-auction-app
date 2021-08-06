<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminConfig;

use App\Banner;
use App\Http\Requests;

class AdminConfigController extends Controller
{
    public function index()
    {
        $config = AdminConfig::where('id', 1)->first();

        return view('layouts.admin_configuration')->with('config', $config);
    }

    public function get_banner($banner_no)
    {
        $banner = Banner::where('banner_no', $banner_no)->first();
        if ($banner) {
            return $banner->url;
        }
        else {
            return '#1';
        }
    }

    public function update_banner(Request $request)
    {
        $banner_no = trim($request->i);
        $url = trim($request->u);
        $banner = Banner::where('banner_no', $banner_no)->first();
        $banner->url = $url;
        if ($banner->save()) {
          return [1, 'Banner Updated', 'Banner ' . $banner_no . ' updated successfully!'];
        }
        else {
            return [0, 'Banner Update Failed'];
        }
    }

    public function update(Request $request)
    {
        $reg_t = trim($request->reg_t);
        $ref_t = trim($request->ref_t);
        $client_id = trim($request->client_id);
        $secret = trim($request->secret);
        $mode = trim($request->mode);
        $end_point = trim($request->end_point);
        $sms_name = trim($request->sms_name);
        $sms_password = trim($request->sms_password);

        if ($reg_t == '') {
            return [0, 'Registration Tokens cannot be blank'];
        }
        if ($ref_t == '') {
            return [0, 'Referral Tokens cannot be blank'];
        }
        if ($client_id == '') {
            return [0, 'Client ID cannot be blank'];
        }
        if ($secret == '') {
            return [0, 'Secret cannot be blank'];
        }
        if ($mode == '') {
            return [0, 'Mode cannot be blank'];
        }
        if ($end_point == '') {
            return [0, 'End Point cannot be blank'];
        }
        if ($sms_name == '') {
            return [0, 'SMS User Name cannot be blank'];
        }
        if ($sms_password == '') {
            return [0, 'SMS Password cannot be blank'];
        }

        $config = AdminConfig::where('id', 1)->first();
        if ($config) {
            $config->register_tokens = $reg_t;
            $config->refer_tokens = $ref_t;
            $config->paypal_paypal_client_id = $client_id;
            $config->paypal_secret = $secret;
            $config->paypal_mode = $mode;
            $config->paypal_end_point = $end_point;
            $config->sms_user_name = $sms_name;
            $config->sms_user_password = $sms_password;
            if ($config->save()) {
                return [1, 'Configuration Updated', 'Admin Configurations updated'];
            } else {
                return [0, 'Failed to update Admin Configurations'];
            }
        } else {
            return [0, 'Failed to update Admin Configurations'];
        }
    }

    public function update_banner_image(Request $request)
    {
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $b = $request->b;
                if ($b) {
                  $i = 'main-banner-' . $b . '.png';
                  $request->file('image')->move(public_path('img'), $i);
                  return redirect()->intended('/');
                }
            }
        }
    }
}
