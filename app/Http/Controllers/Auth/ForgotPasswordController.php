<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use DB;
use Session;
use App\User;
// use App\Mail\PasswordReset;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
     */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm(Request $request)
    {
        // dd($request, $request->getRequestUri(), Str::contains(url()->previous(), 'admin'), \Request::is('admin/*'));
        if (\Request::is('admin/*') && Str::contains(url()->previous(), 'admin')) {
            return view('layouts.admin.password.email');
        }
    }

    public function showLinkRequestFormForUser(Request $request)
    {
        if (!\Request::is('admin/*')) {
            return view('layouts.front.password.email');
        }
    }

    public function sendResetLinkEmail(Request $request)
    {
        // dd($request->all());
        // dd(\Carbon\Carbon::now());
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();
        // dd($user->role);
        if (User::where('email', $request->email)->count() == 0) {
            if (Str::contains(url()->previous(), 'admin')) {
                return redirect('/admin/password/reset')->withInput()->withErrors(array('email' => 'Email does not exist'));
            } else {
                return redirect('/password/reset')->withInput()->withErrors(array('email' => 'Email does not exist'));
            }
        } else {
            $token = str_random(32);
            User::where('email', $request->email)->update([
                'token' => $token
            ]);
            if ($user->role == 1) {
                $url = 'http://localhost/kart/admin/password/reset/' . $token;
            } else {
                $url = 'http://localhost/kart/password/reset/' . $token;
            }
            // dd($url);
            \Mail::send('layouts.admin.emails.reset', ['token' => $token, 'email' => $request->email, 'url' => $url], function ($message) use ($request) {
                $message->from('bluedracoon63@gmail.com', 'Laravel K-art');
                $message->sender('bluedracoon63@gmail.com', 'Laravel K-art');
                $message->to($request->email);
                $message->replyTo('bluedracoon63@gmail.com', 'Laravel K-art');
                $message->subject('Password Reset Link');
            });
            Session::flash('status', 'Kindly check your email for reset link.');
            if ($user->role == 1) {
                return redirect('/admin/password/reset');
            } else {
                return redirect('/password/reset');
            }
        }
    }
}
