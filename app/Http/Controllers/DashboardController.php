<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;
use App\Product;
use App\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orderCount = Orders::all()->count();
        $productCount = Product::all()->count();
        $userCount = User::all()->count();
        $pendingOrders = Orders::where('paymentStatus', 0)->count();
        $confirmedOrders = Orders::where('paymentStatus', 1)->count();
        $cancelledOrders = Orders::where('paymentStatus', 2)->count();
        $dispatchedOrders = Orders::where('paymentStatus', 3)->count();
        $deliveredOrders = Orders::where('paymentStatus', 4)->count();
        $totalOrderAmount = Orders::sum('totalAmount');
        $CODAmount = Orders::whereIn('paymentStatus', [1, 3, 4])->sum('totalAmount');
        $PAmount = Orders::where('paymentStatus', 0)->sum('totalAmount');
        // dd($totalOrderAmount);
        return view(
            'layouts.admin.dashboard',
            compact(
                'orderCount',
                'productCount',
                'userCount',
                'pendingOrders',
                'confirmedOrders',
                'cancelledOrders',
                'dispatchedOrders',
                'deliveredOrders',
                'totalOrderAmount',
                'CODAmount',
                'PAmount',
            )
        );
    }
}
