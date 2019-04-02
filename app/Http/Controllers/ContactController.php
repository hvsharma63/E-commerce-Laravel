<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function index()
    {
        return view('layouts.contact.admin.index');
    }

    public function destroy(Request $request)
    {
        dd($request->all());
    }
}
