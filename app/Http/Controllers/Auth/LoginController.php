<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{


    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(Request $request)
    {
        // dd(url()->previous());
        // dd($request);
        if (\Request::is('admin/*')) {
            return view('layouts.admin.login');
        } else {
            // return redirect('/login');
            if (!Auth::check()) {
                return view('layouts.front.login');
            }
        }
    }

    // public function showUserLoginForm()
    // {
    //     return view('layouts.front.login');
    // }

    public function login(Request $request)
    {
        // dd($request->url());
        // dd($request->all());
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {
            if (Auth::user()->role == 1) {
                return redirect('/admin/dashboard');
            } elseif (Auth::user()->role == 0) {
                // dd()
                return redirect()->intended('/abani');
                // return redirect()->back();
            }
        } else {
            throw ValidationException::withMessages([
                $this->username() => [trans('auth.failed')],
            ]);
        }
    }

    public function logout(Request $request)
    {
        // dd(Auth::user()->role = 1);
        if (Auth::check()) {
            if (Auth::user()->role == 1) {
                Auth::logout();
                return redirect('/admin/login');
            } elseif (Auth::user()->role == 0) {
                Auth::logout();
                return redirect('/login');
            }
        }
    }

    public function checkLogggedIn(Request $request)
    {
        // dd('YES');
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {
            if (Auth::user()->role == 0) {
                return true;
            }
        }
    }
}
