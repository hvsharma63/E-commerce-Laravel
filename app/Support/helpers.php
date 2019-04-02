<?php
 // namespace App\Support;

use App\Product;
use App\Cart;

if (!function_exists('hello')) {

    function hello($str)
    {
        return "Hello " . $str;
    }

    function getSessionData()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 0) {
                $products = \App::call('App\Http\Controllers\CartController@check');
                return $products;
            }
        } else {
            if (Session::get('productsInCart') != null) {
                if (Session::has('productsInCart')) {
                    $productIds = Session::get('productsInCart');
                    $ids = [];
                    if (isset($productIds)) {
                        $productIds = array_values($productIds);
                        for ($i = 0; $i < count($productIds); $i++) {
                            array_push($ids, $productIds[$i]['productId']);
                        }
                        $products = Product::find($ids)->toArray();
                        for ($i = 0; $i < count($productIds); $i++) {
                            for ($j = 0; $j < count($productIds); $j++) {
                                if ($products[$i]['id'] == $productIds[$j]['productId']) {
                                    $products[$i]['productId'] = $productIds[$j]['productId'];
                                    $products[$i]['qty'] = $productIds[$j]['qty'];
                                }
                            }
                        }
                        return $products;
                    }
                }
            }
        }
    }

    function getUserData()
    { }
}
