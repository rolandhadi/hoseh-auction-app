<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\About;
use App\Http\Requests;

class AboutController extends Controller
{
    public function update_about(Request $request)
    {
        $a = About::all()->first();
        if ($a) {
            $a->about = $request->a;
            if ($a->save()) {
                return [1, 'About page successfully updated', 'success'];
            } else {
                return [0, 'About page was not updated', 'error'];
            }
        }
    }

    public function update_footer(Request $request)
    {
        $f = About::all()->first();
        if ($f) {
            $f->footer = $request->f;
            if ($f->save()) {
                return [1, 'Page footer successfully updated', 'success'];
            } else {
                return [0, 'Page footer was not updated', 'error'];
            }
        }
    }

    public static function get_footer()
    {
        $f = About::all()->first();
        if ($f) {
            return $f->footer;
        } else {
            return null;
        }
    }
}
