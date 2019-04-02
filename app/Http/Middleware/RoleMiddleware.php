<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $id = Auth::id();
            if (User::find($id)->role == 1) {
                // if (User::find($id)->email_verified == 1) {
                // return response()->view('layouts.admin.dashboard');
                // } else {
                return $next($request);

                //     Auth::logout();
                //     return response()->view('layouts.admin.login');
                // }
            } else {
                // Auth::logout();
                // dd('YES');
                return redirect()->back();
                // return response()->view('layouts.admin.unauthorized');
            }
        } else {
            return response()->view('layouts.admin.unauthorized');
        }
        return $next($request);
    }
}
