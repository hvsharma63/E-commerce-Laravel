<?php

use App\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('admin/dashboard', function () {
//     return view('admin/dashboard');
// });

Route::get('/abani', function () {
    return view('layouts.front.home');
});

// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// });



Route::group(['prefix' => 'admin', 'middleware' => 'role'], function () {

    Route::get('/dashboard', [
        "uses" => 'DashboardController@index',
        "as" => 'dashboard.index'
    ]);

    Route::get('/profile', 'UserController@showAdminProfile');
    Route::post('/changePassword', 'UserController@changePassword');
    Route::get('/contact', 'ContactController@index');

    Route::group(['prefix' => 'categories'], function () {
        // Showing all Categories
        Route::get('/', [
            "uses" => 'CategoryController@index',
            "as" => 'categories.index'
        ]);

        // Displaying the Category Create Form
        Route::GET('/create', [
            "uses" => 'CategoryController@create',
            "as" => 'categories.create'
        ]);

        // Creating a Category
        Route::POST('/', [
            "uses" => 'CategoryController@store',
            "as" => 'categories.store'
        ]);

        // Editing a Category
        Route::GET('/{id}/edit', [
            "uses" => 'CategoryController@edit',
            "as" => 'categories.edit'
        ]);

        // Updating a Category
        Route::POST('/{id}/update', [
            "uses" => 'CategoryController@update',
            "as" => 'categories.update'
        ]);

        // Deleting a Category
        Route::POST('/delete', [
            "uses" => 'CategoryController@destroy',
            "as" => 'categories.delete'
        ]);

        // Changing status via switch
        Route::GET('/changeStatus', [
            "uses" => 'CategoryController@changeStatus',
            "as" => 'categories.changeStatus'
        ]);

        Route::POST('/checkCategoryName', 'CategoryController@checkCategoryName');
    });

    Route::group(['prefix' => 'colors'], function () {

        // Showing all Colours
        Route::get('/', [
            "uses" => 'ColorController@index',
            "as" => 'colors.index'
        ]);

        // Displaying the Color Create Form
        Route::GET('/create', [
            "uses" => 'ColorController@create',
            "as" => 'colors.create'
        ]);

        // Creating a Color
        Route::POST('/', [
            "uses" => 'ColorController@store',
            "as" => 'colors.store'
        ]);

        // Editing a Color
        Route::GET('/{id}/edit', [
            "uses" => 'ColorController@edit',
            "as" => 'colors.edit'
        ]);

        // Updating a Color
        Route::POST('/{id}/update', [
            "uses" => 'ColorController@update',
            "as" => 'colors.update'
        ]);

        // Deleting a Color
        Route::POST('/delete', [
            "uses" => 'ColorController@destroy',
            "as" => 'colors.delete'
        ]);

        // Changing status via switch
        Route::GET('/changeStatus/', [
            "uses" => 'ColorController@changeStatus',
            "as" => 'colors.changeStatus'
        ]);

        Route::POST('/checkColorName', 'ColorController@checkColorName');
    });

    Route::group(['prefix' => 'products'], function () {

        // Showing all Products
        Route::get('/', [
            "uses" => 'ProductController@index',
            "as" => 'products.index'
        ]);

        // Displaying the Product Create Form
        Route::GET('/create', [
            "uses" => 'ProductController@create',
            "as" => 'products.create'
        ]);

        // Creating a Product
        Route::POST('/', [
            "uses" => 'ProductController@store',
            "as" => 'products.store'
        ]);

        // Editing a Product
        Route::GET('/{id}/edit', [
            "uses" => 'ProductController@edit',
            "as" => 'products.edit'
        ]);

        // Updating a Product
        Route::POST('/{id}/update', [
            "uses" => 'ProductController@update',
            "as" => 'products.update'
        ]);

        // Deleting a Product
        Route::POST('/delete', [
            "uses" => 'ProductController@destroy',
            "as" => 'products.delete'
        ]);

        // Changing status via switch
        Route::POST('/changeStatus', [
            "uses" => 'ProductController@changeStatus',
            "as" => 'products.changeStatus'
        ]);

        // Deleting Image of Multiple Images
        Route::POST('/delete/multipleImage', [
            "uses" => 'ProductController@deleteMultipleImage',
            "as" => 'products.deleteMultipleImage'
        ]);
    });

    Route::group(['prefix' => 'orders'], function () {

        // Showing all Orders
        Route::get('/', [
            "uses" => 'OrderController@showOrders',
            "as" => 'orders.showOrders'
        ]);

        Route::post('/getProductsByOrder', 'OrderController@getProductsByOrder');
        Route::post('/delete', 'OrderController@destroy');
        Route::post('/changePaymentStatus', 'OrderController@changePaymentStatus');
    });

    Route::group(['prefix' => 'users'], function () {

        // Showing all Users
        Route::get('/', [
            "uses" => 'UserController@showUsers',
            "as" => 'users.showUsers'
        ]);

        // Change status of Users
        Route::post('/changeStatus', [
            "uses" => 'UserController@changeStatus',
            "as" => 'users.changeStatus'
        ]);

        Route::post('/delete', 'UserController@destroy');
    });
});

Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
});

// Front-side Routes
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('kart/login');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');
Route::get('/products', 'ProductController@showAllProducts');
Route::get('/products/{id}', 'ProductController@showSingleProduct');
Route::post('/viewProducts', 'ProductController@viewProducts');
Route::get('/cart', 'CartController@index');
// Route::post('/addToCart', 'ProductController@storeAddedProducts');
Route::get('/session/get', 'CartController@accessSessionData');
Route::post('/session/addSingleProductToCart', 'CartController@storeSessionData');
Route::post('/session/deleteSingleProduct', 'CartController@deleteSingleProduct');
Route::get('/session/remove', 'CartController@deleteSessionData');

// Route::get('/testing/incrementProductQuantity', 'ProductController@incrementProductQuantity');
// Route::get('/testing/addProduct', 'ProductController@addProduct');

Route::get('/checkout', 'OrderController@checkout');
Route::get('/checkout/step2', 'OrderController@checkoutStep2');

Route::get('/checkout/step3', 'OrderController@checkoutStep3');
Route::post('/checkout/step3', 'OrderController@billingAddress');

Route::get('/checkout/step5', 'OrderController@checkoutStep5');
Route::post('/checkout/step5', 'OrderController@shippingAddress');

Route::post('/order/confirm', 'OrderController@confirmOrder');
// // Route::get('/checkout', 'OrderController@checkout');
Route::post('/qty/action', 'CartController@action');

// // Route::post('/order/billingAddress', 'OrderController@billingAddress');
// Route::post('/order/ShippingAddress', 'OrderController@shippingAddress');
// Route::post('/checkLogggedIn', 'LoginController@checkLogggedIn')->name('checkLoggedIn');

Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestFormForUser')->name('user.password.request');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('user.password.reset');

Route::get('/440', function () {
    return view('layouts.front.440');
});

Route::get('/500', function () {
    return view('layouts.front.thankyou');
});

Route::get('/orders', 'OrderController@index');
Route::post('/getProductsByOrder', 'OrderController@getProductsByOrder');

Route::get('/profile', 'UserController@index');
