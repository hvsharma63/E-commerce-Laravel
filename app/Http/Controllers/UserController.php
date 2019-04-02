<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Billings;
use App\Shippings;
use Auth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $billings = Billings::where('userId', Auth::user()->id)->get();
        $shippings = Shippings::where('userId', Auth::user()->id)->get();
        return view('layouts.user.front.profile', compact('billings', 'shippings'));
    }

    public function showUsers()
    {
        $users = User::where('status', 'Y')->get();
        return view('layouts.user.admin.index', compact('users'));
    }

    // public function changeStatus(Request $request)
    // {
    //     $user = User::find($request->id);
    //     if ($user->status == 'N') {
    //         $user->status = 'Y';
    //     } else {
    //         $user->status = 'N';
    //     }
    //     $user->save();
    //     return ['data' => true, 'message' => 'User Status Changed'];
    // }

    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            $user->status = 'T';
            $user->save();
            return ['data' => true, 'message' => 'User has been deleted successfully'];
        } else {
            return ['data' => false, 'message' => 'User cannot be deleted'];
        }
    }

    public function showAdminProfile(Request $request)
    {
        return view('layouts.user.admin.profile');
    }

    public function changePassword(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'oldPassword' => ['required'],
            'newPassword' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        if ($validator->fails()) {
            // dd($validator);
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if (Hash::check($request->oldPassword, Auth::user()->password)) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->newPassword);
            $user->save();
            session()->put('success', 'Password has been updated!.');
            return redirect()->back();
        }
    }
}
