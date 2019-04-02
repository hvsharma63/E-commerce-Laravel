<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use App\Cart;
use App\Product;
use Redirect;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = getSessionData();

        // dd($products);
        return view('layouts.product.front.view-cart', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function accessSessionData(Request $request)
    {
        if ($request->session()->has('productsInCart')) {
            // dd(\App::call('App\Http\Controllers\CartController@check'));
            dd($request->session()->get('productsInCart'));
        } else {
            echo 'No data in the session';
        }
    }

    public function storeSessionData(Request $request)
    {
        // print_r($request->all());
        // die;
        if (Auth::check()) {
            if (Auth::user()->role == 0) {
                if (Cart::where('userId', '=', Auth::user()->id)
                    ->where('productId', '=', $request->productId)
                    ->exists()) {
                    $cart = Cart::where('userId', '=', Auth::user()->id)
                        ->where('productId', '=', $request->productId)
                        ->update(['qty' => $request->quantity]);
                    return ['response' => true];
                } else {
                    $cart = new Cart;
                    $cart->userId = Auth::user()->id;
                    $cart->productId = $request->productId;
                    $cart->qty = $request->quantity;
                    $cart->save();
                    return ['response' => true];
                }
            }
        } else {
            if (Session::has('productsInCart')) {
                foreach (Session::get('productsInCart') as $key => $value) {
                    if ($value['productId'] === $request->productId) {
                        return ['response' => false, 'message' => 'This product is already in the cart!'];
                    }
                }
            }
            $item = ['productId' => $request->productId, 'qty' => $request->quantity];
            $request->session()->push('productsInCart', $item);
            $data = "Data has been added to session";
            return ['response' => true, 'message' => 'Product added to the cart'];
        }
    }

    public function deleteSessionData(Request $request)
    {
        $request->session()->forget('productsInCart');
        echo "Data has been removed from session.";
        return ['data' => true];
    }

    public function deleteSingleProduct(Request $request)
    {
        // $session = Session::get('productsInCart');
        $remove = $request->productId;
        if (Auth::check()) {
            if (Auth::user()->role == 0) {
                Cart::where('productId', $request->productId)->where('userId', Auth::user()->id)->delete();
            }
        } else {
            if (Session::has('productsInCart')) {
                foreach (Session::get('productsInCart') as $key => $value) {
                    if ($value['productId'] == $remove) {
                        $request->session()->forget('productsInCart.' . $key);
                    }
                }
            }
        }
        $productPrice = Product::find($request->productId)->price;
        return ['data' => true, 'message' => 'Product deleted from the cart', 'productPrice' => $productPrice];
    }

    public function action(Request $request)
    {
        // print_r($request->all());
        // die;
        if (Auth::check()) {
            if (Auth::user()->role == 0) {
                Cart::where('userId', '=', Auth::user()->id)
                    ->where('productId', '=', $request->id)
                    ->update(['qty' => $request->qty]);
            }
            $productPrice = Product::find($request->id)->price;
            $calculatedPrice = $productPrice * $request->qty;
            return ['data' => true, 'message' => 'quantity changed', 'price' => $calculatedPrice];
        } else {
            if (Session::has('productsInCart')) {
                foreach (Session::get('productsInCart') as $key => $value) {
                    if ($value['productId'] == $request->id) {
                        $temp = ['productId' => $value['productId'], 'qty' => $request->qty];
                        $request->session()->forget('productsInCart.' . $key);
                        $request->session()->push('productsInCart', $temp);
                    }
                }
            }
            $productPrice = Product::find($request->id)->price;
            $calculatedPrice = $productPrice * $request->qty;
            $request->session()->save();
            return ['data' => true, 'message' => 'quantity changed', 'price' => $calculatedPrice];
        }
    }

    // public function checkout(Request $request)
    // {
    //     $var = $request->path();
    //     if (Auth::user() == null) {
    //         return redirect('/login');
    //     } else {
    //         return view('layouts.order.front.checkout-step1');
    //     }
    // }

    public function check()
    {
        if (Auth::user()->role == 0) {
            if (Session::has('productsInCart')) {
                $session = Session::get('productsInCart');
                $session = array_values($session);

                for ($i = 0; $i < count($session); $i++) {
                    if (Cart::where('userId', '=', Auth::user()->id)
                        ->where('productId', '=', $session[$i]['productId'])
                        // ->where('qty', '=', $session[$i]['qty'])
                        ->exists()) {
                        $cart[$i] = Cart::where('userId', '=', Auth::user()->id)
                            ->where('productId', '=', $session[$i]['productId'])
                            ->update(['qty' => $session[$i]['qty']]);
                    } else {
                        $cart[$i] = new Cart;
                        $cart[$i]->userId = Auth::user()->id;
                        $cart[$i]->productId = $session[$i]['productId'];
                        $cart[$i]->qty = $session[$i]['qty'];
                        $cart[$i]->save();
                    }
                }
                Session::forget('productsInCart');
            }
            // $cart = Cart::where('userId', Auth::user()->id)->get()->toArray();
            $products = Cart::join('users', 'cart.userId', '=', 'users.id')
                ->join('products', 'cart.productId', '=', 'products.id')
                ->select('cart.*', 'products.price as price', 'products.thumbnail', 'products.name')
                // ->select('cart.*', 'cart.productId as productId', 'products.thumbnail', 'products.name')
                ->where('cart.userId', Auth::user()->id)
                ->get()->toArray();
            return $products;
        }
    }
}
