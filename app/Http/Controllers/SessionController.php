<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    //
    public function accessSessionData(Request $request)
    {
        if ($request->session()->has('APRR'))
            dd($request->session()->get('APRR'));
        else
            echo 'No data in the session';
    }
    public function storeSessionData(Request $request)
    {
        // dd($request->all());
        $request->session()->push('APRR.id', $request->productId);
        echo "Data has been added to session";
    }
    public function deleteSessionData(Request $request)
    {
        $request->session()->forget('APRR');
        echo "Data has been removed from session.";
    }
}
