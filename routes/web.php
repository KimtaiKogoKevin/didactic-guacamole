<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes(['register'=> true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Admin dashboard

Route::group(['prefix'=>'admin','middleware' => 'auth'],function(){
    Route::get('/',[AdminController::class,'admin'])->name('admin');



    //Banner Section
    Route::resource('banner',\App\Http\Controllers\BannerController::class);
    Route::post('banner_status',[\App\Http\Controllers\BannerController::class,'bannerStatus'])->name('banner.status');

    //Categories Section
    Route::resource('categories',\App\Http\Controllers\CategoryController::class);
    Route::post('categories_status',[\App\Http\Controllers\CategoryController::class,'categoryStatus'])->name('categories.status');

    Route::post('category/{id}/child',[\App\Http\Controllers\CategoryController::class,'getChildByParentID']);

    //Brand Section
    Route::resource('brands',\App\Http\Controllers\BrandController::class);
    Route::post('brand_status',[\App\Http\Controllers\BrandController::class,'brandStatus'])->name('brand.status');

    //Product Section
    Route::resource('products',\App\Http\Controllers\ProductsController::class);
    Route::post('product_status',[\App\Http\Controllers\ProductsController::class,'productsStatus'])->name('product.status');


    //laravel file manager
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });








});
