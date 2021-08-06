<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\UserTestimonial;

class UserTestimonialController extends Controller
{

    public function show_testimonials()
    {
        $testimonials = UserTestimonial::orderBy('id', 'desc')->paginate(25);
        $out['users_testimonial_total'] = UserTestimonial::count();
        $out['users_testimonial_history'] = $testimonials->links();
        foreach ($testimonials as $d => $testimonial) {
            if ($testimonial->img) {
                $img = asset('testimonial-imgs/' . $testimonial->img);
            } else {
                $img = asset('img/' . 'no-image.png');
            }
            $out['testimonials'][$d] = [
                'testimonial_id' => $testimonial->id,
                'created_at' => $testimonial->created_at,
                'name' => $testimonial->name,
                'message' => $testimonial->message,
                'image' => $img
            ];
        }

        return view('layouts.users_testimonials')->with('testimonials', $out);
    }

    public function add_testimonial(Request $request)
    {
        $testimonial = new UserTestimonial;
        if (($request->n) || ($request->m)) {
            $testimonial->name = $request->n;
            $testimonial->message = $request->m;
            if ($testimonial->save()) {
                return [1, 'User Testimonial', 'User testimonials added'];
            } else {
                return [0, 'Cannot add testimonials'];
            }
        } else {
            return [0, 'Name and Message cannot be blank'];
        }
    }

    public function update_testimonial(Request $request)
    {
        $testimonial = UserTestimonial::where('id', $request->t)->first();
        if ($testimonial) {
            if (($request->n) || ($request->m)) {
                $testimonial->name = $request->n;
                $testimonial->message = $request->m;
                if ($testimonial->save()) {
                    return [1, 'User Testimonial', 'User testimonials updated'];
                } else {
                    return [0, 'Cannot update testimonials'];
                }
            } else {
                return [0, 'Name and Message cannot be blank'];
            }
        }
    }

    public function delete_testimonial(Request $request)
    {
        $testimonial = UserTestimonial::where('id', $request->t)->first();
        if ($testimonial) {
            if ($testimonial->delete()) {
                return [1, 'User Testimonial', 'User testimonials deleted'];
            } else {
                return [0, 'Cannot delete testimonials'];
            }
        }
    }

    public function add_image(Request $request)
    {
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $v = explode('|', $request->t);
                $t = UserTestimonial::where('id', '=', $v[1])->first();
                if ($t) {
                    $t->img = $t->id . '.' . pathinfo($request->file('image')->getClientOriginalName(),
                            PATHINFO_EXTENSION);
                    $request->file('image')->move(public_path('testimonial-imgs'), $t->img);
                    $t->save();

                    return redirect($v[0]);
                }
            }
        }
    }

}
