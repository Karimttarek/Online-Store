<?php

use App\Http\Controllers\General\SocialController;
use App\Http\Controllers\site\CustomController;
use App\Http\Controllers\site\ProductController;
use App\Http\Controllers\site\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

const PAGINATION_COUNT = '15';
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){ //...

    // SOCIAL
    Route::get('redirect/{service}' , [SocialController::class, 'redirect']);
    Route::get('callback/{service}' , [SocialController::class, 'callback']);

    Auth::routes(['verify' => true]);


    Route::prefix('/')->middleware('verified')->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    });


    Route::get('/' , [ \App\Http\Controllers\indexController::class , 'index'])->name('index');
    Route::get('search' , [\App\Http\Controllers\indexController::class , 'searchMenu'])->name('searchMenu');


    Route::get('all-products' , [productController::class , 'allProducts'])->name('allproducts');
    Route::get('product-details/{id}' ,[productController::class , 'productDetail'])->name('productDetail');
    Route::get('category/{id}' , [\App\Http\Controllers\site\CategoryController::class , 'index'])->name('category.product');
    Route::get('/filter' , [\App\Http\Controllers\site\CategoryController::class , 'filter'])->name('filter.category');


// USER ROUTE
//    Route::get('profile' , [UserController::class , 'index'])->name('profile');

    /***
     * CART AND WISHLIST ROUTES
     */

    Route::get('wishlist' , [ProductController::class , 'wishlist'])->name('wishlist');
    Route::get('cart' , [CustomController::class , 'cartPage'])->name('cart');
    Route::get('cart/add' , [ProductController::class , 'addToCart'])->name('cart.add');
    Route::get('cart/delete' , [CustomController::class , 'deleteCart'])->name('cart.delete');
    Route::get('cart/update' , [CustomController::class , 'updateCartQuantity'])->name('cart.updateQuantity');
    // Checkout an billin
    Route::get('checkout' , [CustomController::class , 'checkout'])->name('checkout');
    Route::post('billing' , [CustomController::class , 'billing'])->name('checkout.billing');


    Route::get('contact' , function (){
        return view('site.contact');
    })->name('contact');
    /***
     * End
     */
});

