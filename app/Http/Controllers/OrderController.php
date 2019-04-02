<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Cart;
use App\Product;
use App\Billings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Shippings;
use Session;
use App\Orders;
use App\OrderProducts;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showOrders()
    {
        $orders = Orders::where('status', 'Y')->get();
        return view('layouts.order.admin.index', compact('orders'));
    }

    public function index()
    {
        $orders = Orders::where('userId', Auth::user()->id)->get();
        // dd($orders);
        return view('layouts.order.front.orders', compact('orders'));
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
    public function destroy(Request $request)
    {
        //
        // var_dump($request->all());
        $order = Orders::find($request->id);
        if ($order) {
            $order->status = 'T';
            $order->save();
            return ['data' => true, 'message' => 'Order has been deleted successfully'];
        } else {
            return ['data' => false, 'message' => 'Order cannot be deleted'];
        }
    }

    public function checkout(Request $request)
    {
        // dd($request->all());
        // if (Auth::user() == null) {
        //     // if (\App::call('App\Http\Controllers\Auth\LoginController@checkLogggedIn') == true) {
        //     //     return redirect()->back();
        //     // };
        // } else {
        //     $cartProducts = Cart::where('userId', Auth::user()->id)->count();
        //     if ($cartProducts > 0) {
        return redirect('/checkout/step2');
        // return view('layouts.order.front.checkout-step1', compact('billingAddresses', $billingAddresses));
        //     } else {
        //         return redirect('/cart');
        //     }
        // }
    }

    public function checkoutStep2(Request $request)
    {
        // dd($request->all());
        if (Cart::where('userId', Auth::user()->id)->count() > 0) {
            $billingAddresses = Billings::where('userId', Auth::user()->id)->get();
            return view('layouts.order.front.checkout-step1', compact('billingAddresses', $billingAddresses));
        } else {
            return redirect('/cart');
        }
    }
    public function billingAddress(Request $request)
    {
        // dd($request->all());
        // $validator = Validator::make($request->all(), [
        //     'payment_radio' => ['required'],
        //     'firstName' =>  ['required', 'string'],
        //     'lastName' => ['required', 'string'],
        //     'address' => ['required', 'string'],
        //     'email' => ['required', 'email'],
        //     'city' => ['required', 'string'],
        //     'state' => ['required', 'string'],
        //     'mobile' => ['required'],
        //     'zip' => ['required'],
        //     'fax' => ['required'],
        //     'shipping_method' => ['required'],
        // ], $messages = [
        //     'payment_radio.required' => 'Kindly select the addresses or create a new address'
        // ]);
        // if ($validator->fails()) {
        //     // dd($validator);
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        // dd($request->all());
        $data = $request->all();
        unset($data['_token'], $data['payment_radio'], $data['type'], $data['shipping_method'], $data['created_at'], $data['updated_at']);
        if (is_numeric($request->payment_radio) && is_null($request->type)) {
            $billingAddress = Billings::find($request->payment_radio);
        } elseif (is_numeric($request->payment_radio) && !is_null($request->type)) {
            if ($request->type == 'edit') {
                Billings::where('id', $request->payment_radio)->update($data);
                if ($request->shipping_method == 'same') {
                    Shippings::where('userId', Auth::user()->id)->where('billingId', $request->payment_radio)->update($data);
                }
                $billingAddress = Billings::find($request->payment_radio);
            }
        } elseif (!is_numeric($request->payment_radio) && !is_null($request->type)) {
            if ($request->payment_radio == 'new' && $request->type == 'new') {
                $data['userId'] = Auth::user()->id;
                // dd($data);
                $billingAddress = Billings::firstOrCreate($data, $data);
                // $billingAddress = Billings::create($data);
                // $billingAddress = Billings::find($billingAddress->id);
            }
        }
        $billingId = $billingAddress->id;

        if ($request->shipping_method == 'same') {
            // $shippingAddresses = Shippings::where('userId', Auth::user()->id)->where('billingId', $billingId)->get();
            $billingData = $billingAddress->toArray();
            $billingData['billingId'] = $billingData['id'];
            unset($billingData['id'], $billingData['created_at'], $billingData['updated_at']);
            // dd($billingData);
            $shippingAddresses = Shippings::firstOrcreate($billingData, $billingData);
            // $productsOfCart = Cart::join('products', 'cart.productId', '=', 'products.id')
            //     ->select('cart.*', 'products.name as productName', 'products.price as productPrice')
            //     ->get()->where('userId', Auth::user()->id);

            // if (count($shippingAddresses) == 0) {
            // dd($billingData);
            // dd($billingAddress, $shippingAddresses);
            // $shippingAddresses = $shippingAddresses->toArray();
            // } else {
            // $shippingAddresses = $shippingAddresses->toArray();
            // }
            // dd($shippingAddresses, $billingAddress);
            $shippingId = $shippingAddresses->id;
            Session::put('billingId', $billingId);
            Session::put('shippingId', $shippingId);
            return redirect('/checkout/step5');
            // return view('layouts.order.front.checkout-step3', compact('billingAddress', 'shippingAddresses', 'productsOfCart'));
        } elseif ($request->shipping_method == 'different') {
            Session::put('billingId', $billingId);
            return redirect('/checkout/step3');
            // $shippingAddresses = Shippings::where('userId', Auth::user()->id)->get();
            // return view('layouts.order.front.checkout-step2', compact('billingAddress', 'shippingAddresses'));
        }
    }

    public function checkoutStep3(Request $request)
    {
        // dd($request->session()->get('billingId'));
        if (Cart::where('userId', Auth::user()->id)->count() > 0 && !is_null(Session::get('billingId'))) {
            $billingAddress = Billings::find($request->session()->get('billingId'));
            $shippingAddresses = Shippings::where('userId', Auth::user()->id)->get();
            return view('layouts.order.front.checkout-step2', compact('billingAddress', 'shippingAddresses'));
        } else {
            return redirect('/cart');
        }
    }

    public function shippingAddress(Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        unset($data['_token'], $data['shipping_id'], $data['type'], $data['created_at'], $data['updated_at']);
        if (is_numeric($request->shipping_id) && is_null($request->type)) {
            $shippingAddresses = Shippings::find($request->shipping_id);
        } elseif (is_numeric($request->shipping_id) && !is_null($request->type)) {
            if ($request->type == 'edit') {
                Shippings::where('id', $request->shipping_id)->update($data);
                $shippingAddresses = Shippings::find($request->shipping_id);
            }
        } elseif (!is_numeric($request->shipping_id) && !is_null($request->type)) {
            if ($request->shipping_id == 'new' && $request->type == 'new') {
                $data['userId'] = Auth::user()->id;
                $data['billingId'] = null;
                // dd($data);
                $shippingAddresses = Shippings::firstOrCreate($data, $data);
            }
        }
        $shippingId = $shippingAddresses->id;
        Session::put('shippingId', $shippingId);
        // dd($shippingId);
        return redirect('/checkout/step5');
        // $productsOfCart = Cart::join('products', 'cart.productId', '=', 'products.id')
        //     ->select('cart.*', 'products.name as productName', 'products.price as productPrice')
        //     ->get()->where('userId', Auth::user()->id);
        // // dd($productsOfCart);
        // $billingAddress = Billings::find($request->billingId);
        // return view('layouts.order.front.checkout-step3', compact('billingAddress', 'shippingAddresses', 'productsOfCart'));
    }

    public function checkoutStep5(Request $request)
    {
        if (Cart::where('userId', Auth::user()->id)->count() > 0 && !is_null(Session::get('shippingId')) && !is_null(Session::get('billingId'))) {
            $productsOfCart = Cart::join('products', 'cart.productId', '=', 'products.id')
                ->select('cart.*', 'products.name as productName', 'products.price as productPrice')
                ->get()->where('userId', Auth::user()->id);
            $shippingAddresses = Shippings::find(Session::get('shippingId'));
            $billingAddress = Billings::find(Session::get('billingId'));
            return view('layouts.order.front.checkout-step3', compact('billingAddress', 'shippingAddresses', 'productsOfCart'));
        } else {
            return redirect('/checkout');
        }
    }
    public function confirmOrder(Request $request)
    {
        // dd($request->all(), Session::get('billingId'), Session::get('shippingId'));
        $cart = Cart::where('userId', Auth::user()->id)->get()->toArray();
        // dd($cart);
        $totalAmount = 0;
        $totalQty = 0;
        // dd($cart);
        $billings = Billings::find(Session::get('billingId'));
        for ($i = 0; $i < count($cart); $i++) {
            $totalQty = $totalQty + $cart[$i]['qty'];
            $individualPrice = $cart[$i]['qty'] * Product::find($cart[$i]['productId'])->price;
            $totalAmount = $totalAmount + $individualPrice;
        }
        $data = [
            'userId' => Auth::user()->id,
            'billingId' => Session::get('billingId'),
            'shippingId' => Session::get('shippingId'),
            'name' => $billings->firstName . " " . $billings->lastName,
            'totalAmount' => $totalAmount,
            'totalQty' => $totalQty,
        ];
        $orders = Orders::firstOrCreate($data, $data);

        for ($i = 0; $i < count($cart); $i++) {
            $data = [
                'orderId' => $orders->id,
                'productId' => $cart[$i]['productId'],
                'productPrice' => Product::find($cart[$i]['productId'])->price,
                'productQty' => $cart[$i]['qty'],
            ];
            $orderProducts = OrderProducts::firstOrCreate($data, $data);
        }
        if (Cart::where('userId', Auth::user()->id)->exists()) {
            Cart::where('userId', Auth::user()->id)->delete();
        }
        Session::forget('shippingId');
        Session::forget('billingId');
        return redirect('/500');
    }

    public function getProductsByOrder(Request $request)
    {
        // $orderProducts = OrderProducts::where('orderId', $request->orderId)->get();
        $products = OrderProducts::where('orderproducts.orderId', '=', $request->orderId)
            ->join('products', 'products.id', '=', 'orderproducts.productId')
            ->select('orderproducts.*', 'products.name as productName')
            ->whereNotIn('orderproducts.status', ['T'])->get();
        return json_encode($products);
        // return ['response' => true, 'products' => json_encode($products)];
    }

    public function changePaymentStatus(Request $request)
    {
        $order = Orders::find($request->id);
        if ($order) {
            $order->paymentStatus = $request->value;
            $order->save();
            return ['data' => true, 'message' => 'Order Status Changed'];
        } else {
            return ['data' => false, 'message' => 'Something went wrong'];
        }
    }
}
