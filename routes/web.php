<?php


use App\Http\Controllers\ProductController;
use App\Http\Controllers\WarehouseController;
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

Auth::routes();

Route::middleware(['auth',])->group(function(){
    Route::post('products/filter',[ProductController::class, 'filterProducts'])->name('products.filter');
    Route::post('products/find',[ProductController::class, 'findProducts'])->name('products.find');
    Route::get('products/order/{field}',[ProductController::class,'orderProducts'])->name('products.order');
    Route::resources([
        'warehouse'=> WarehouseController::class,
        'products'=> ProductController::class
    ]);
    Route::get('warehouse/{id}/products',[ProductController::class, 'warehouseProducts'])->name('warehouseProducts');

});





Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
