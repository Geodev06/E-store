<?php

use App\Http\Controllers\Admin_auth_controller;
use App\Http\Controllers\Admmin_dashboard_controller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Common_controller;
use App\Http\Controllers\Product_controller;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('admin.login');
})->name('verification.verify');


Route::controller(Admin_auth_controller::class)->group(function () {

    Route::get('admin-sign-up', 'admin_sign_up')->name('admin.signup');
    Route::get('admin-login', 'admin_login')->name('admin.login');

    Route::post('admin-register', 'admin_register')->name('admin.register');
    Route::post('admin-signin', 'admin_signin')->name('admin.signin');
});

Route::controller(Admmin_dashboard_controller::class)->group(function () {
    Route::get('admin-dashboard', 'admin_dashboard')->name('admin.dashboard')->middleware(['auth','check_admin']);
    Route::get('admin-settings', 'admin_settings')->name('admin.settings')->middleware(['auth','check_admin']);
    Route::post('admin-settings/save-store-info', 'save_store_info')->name('save_store_info')->middleware(['auth','check_admin']);
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('product-category', 'index')->name('category')->middleware(['auth','check_admin']);
    Route::get('product-category-edit/{id}', 'get')->name('category.get')->middleware(['auth','check_admin']);
    Route::post('product-category-update/{id}', 'update')->name('category.update')->middleware(['auth','check_admin']);
    Route::delete('product-category-delete/{id}', 'delete')->name('category.delete')->middleware(['auth','check_admin']);
    Route::get('product-category/table', 'category_table')->name('category_table')->middleware(['auth','check_admin']);
    Route::post('product-category/save', 'store')->name('category.store')->middleware(['auth','check_admin']);

});

Route::controller(Product_controller::class)->group(function () {
    Route::get('product-item', 'index')->name('product')->middleware(['auth','check_admin']);
    Route::get('product-product/table', 'product_table')->name('product_table')->middleware(['auth','check_admin']);
    Route::post('product-item/save', 'store')->name('product.store')->middleware(['auth','check_admin']);
    Route::get('product-item-get/{id}', 'get')->name('product.get')->middleware(['auth','check_admin']);
    Route::post('product-item-update/{id}', 'update')->name('product.update')->middleware(['auth','check_admin']);
    Route::delete('product-item-delete/{id}', 'delete')->name('product.delete')->middleware(['auth','check_admin']);

});




Route::post('logout',  function () {
    Auth::logout();
    return response()->json(['link' => route('admin.login')], 200);
})->name('user.logout');