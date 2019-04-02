<?php

namespace App\Http\Controllers\Auth;

use Auth;
use DB;
use Hash;
use Session;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
     */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm(Request $request, $token = null)
    {
        // dd($user)
        $user = User::where(['token' => $request->token])->first();
        // dd($user, $request->token, $user->email);
        if (User::where(['token' => $request->token])->count() == 1) {
            if ($user->role == 1) {
                return view('layouts.admin.password.reset')->with(
                    ['token' => $token, 'email' => $user->email]
                );
            } else {
                return view('layouts.front.password.reset')->with(
                    ['token' => $token, 'email' => $user->email]
                );
            }
        } else {
            // Session::flash('message', 'Sorry, the session expired');
            if (!$user) {
                return view('layouts.front.404');
            }
        }
    }

    public function reset(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        if ($validator->fails()) {
            // dd($validator);
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // dd($request->all());
        // dd($request->email, $request->token);
        // dd($user);
        if (User::where('email', $request->email)->where('token', $request->token)->count() == 1) {
            // dd('token', $request->password);
            User::where('email', $request->email)->update(['password' => Hash::make($request->password), 'token' => null]);
            // dd($user->first()->role);
            if (User::where('email', $request->email)->first()->role == 1)
                return redirect('admin/login');
            else
                return redirect('/login');
        } else {
            return redirect('/440');
        }
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [];
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
