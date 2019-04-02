<?php

namespace App\Http\Controllers;

use App\Color;
use App\Product;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $data = Color::all()->whereIn('status', ['Y', 'N']);
        return view('layouts.color.admin.index')->withData($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('layouts.color.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if ((Color::where('colorName', '=', $request->colorName))->exists()) {
            return ['status' => false, 'message' => 'Color Already Exists'];
        }
        // dd($request->all());
        $data = $this->validate($request, [
            'colorName' => ['required', 'string', 'alpha_dash', 'max:255'],
        ]);
        Color::create($request->all());
        session()->put('success', 'Color created successfully.');
        return redirect(route('colors.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function changeStatus(Request $request)
    {
        $color = Color::find($request->id);
        if ((Product::where('colorId', '=', $request->id))->exists()) {
            return ['data' => false, 'message' => 'You cannot change ths status of the color, as it is in use.'];
        } else {
            if ($color->status == 'N') {
                $color->status = 'Y';
            } else {
                $color->status = 'N';
            }
        }
        $color->save();
        return ['data' => true, 'message' => 'Color Status Changed'];
        // return redirect(route('colors.index'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $color = Color::find($id);
        return view('layouts.color.admin.update')->with('Color', $color);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $color = Color::find($id);
        $color->colorName = $request->colorName;
        $color->save();
        session()->put('success', 'Color updated!.');
        return redirect(route('colors.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //

        $color = Color::find($request->id);
        if ($color->status == 'N') {
            $color->status = 'T';
        } else {
            return ['data' => false, 'message' => 'Color cannot be deleted'];
        }
        $color->save();
        return ['data' => true, 'message' => 'Color deleted successfully'];
    }

    public function checkColorName(Request $request)
    {
        if (Color::where('colorName', $request->name)->exists()) {
            return ['data' => false, 'message' => 'This Color already exists'];
        } else {
            return ['data' => true];
        }
    }
}
