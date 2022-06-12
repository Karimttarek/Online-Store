<?php

use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\SubcategoryController;
use App\Http\Controllers\DeleteModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('setting/DB/all/delete', [DeleteModels::class , 'index']);

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ] ], function() {

    // ############################################# Dashboard ############################################# //
    Route::prefix('dashboard')->middleware('Authdashboard')->group(function () {

        Route::get('', function () {return view('dashboard.dashboard');})->name('dashboard'); // main dashboard

        // ############################################# Category ############################################# //
        Route::prefix('category')->group( function (){
            Route::get('' , [CategoryController::class , 'index']) ->name('category.index');
            Route::get('create' , [CategoryController::class , 'create']) ->name('category.create');
            Route::Post('store' , [CategoryController::class , 'store']) ->name('category.store');
            Route::get('edit/{id}' , [CategoryController::class , 'edit']) ->name('category.edit');
            Route::post('update/{id}' , [CategoryController::class , 'update']) ->name('category.update');
//            Route::get('delete/{id}' , [CategoryController::class , 'destroy'])->name('category.delete');
            Route::get('destroy' , [CategoryController::class , 'destroy'])->name('category.delete');
        });
        // ############################################# Sub Category ############################################# //
        Route::prefix('subcategory')->group( function (){
            Route::get('' , [SubcategoryController::class , 'index']) ->name('subcategory.index');
            Route::get('data' , [SubcategoryController::class , 'data']) ->name('subcategory.data');
            Route::get('create' , [SubcategoryController::class , 'create']) ->name('subcategory.create');
            Route::Post('store' , [SubcategoryController::class , 'store']) ->name('subcategory.store');
            Route::get('edit/{id}' , [SubcategoryController::class , 'edit']) ->name('subcategory.edit');
            Route::post('update/{id}' , [SubcategoryController::class , 'update']) ->name('subcategory.update');
//            Route::get('delete/{id}' , [SubcategoryController::class , 'destroy'])->name('subcategory.delete');
            Route::get('destroy' , [SubcategoryController::class , 'destroy'])->name('subcategory.delete');
        });
        // ############################################# Brand ############################################# //
        Route::prefix('brand')->group( function (){
            Route::get('' , [BrandController::class , 'index']) ->name('brand.index');
            Route::get('create' , [BrandController::class , 'create']) ->name('brand.create');
            Route::Post('store' , [BrandController::class , 'store']) ->name('brand.store');
            Route::get('edit/{id}' , [BrandController::class , 'edit']) ->name('brand.edit');
            Route::post('update/{id}' , [BrandController::class , 'update']) ->name('brand.update');
            Route::get('destroy' , [BrandController::class , 'destroy'])->name('brand.delete');
        });
        // ############################################# Brand ############################################# //
                Route::prefix('product')->group( function (){
                    Route::get('' , [ProductController::class , 'index']) ->name('product.index');
                    Route::get('create' , [ProductController::class , 'create']) ->name('product.create');
                    Route::Post('store' , [ProductController::class , 'store']) ->name('product.store');
                    Route::get('edit/{id}' , [ProductController::class , 'edit']) ->name('product.edit');
                    Route::post('update/{id}' , [ProductController::class , 'update']) ->name('product.update');
                    Route::get('destroy' , [ProductController::class , 'destroy'])->name('product.delete');

                    Route::get('/sub' , [ProductController::class , 'getSubCategory'])->name('getSubCategory');
                    Route::get('/brand' , [ProductController::class , 'getBrands'])->name('getBrands');
                    Route::post('x' , [ProductController::class , 'upload'])->name('uploadImage');
                });

    });

});
