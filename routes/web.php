<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Main\AreaController;
use App\Http\Controllers\Admin\Main\BillController;
use App\Http\Controllers\Admin\Main\MainController;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

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

Route::get('/',[AuthController::class,'login']);

Auth::routes();


Route::group(['prefix'=>'admin'], function (){
        Route::get('login', [AuthController::class,'login'])->name('admin-login');
        Route::post('login-check', [AuthController::class,'loginCheck'])->name('login-check');
        Route::get('telgram',function(){
             $update=Telegram::getUpdates();
             dd($update);
             Telegram::sendMessage([
                'chat_id'=>'-849059038',
                'text'=>'kjdfjkdfdfjkdfkjkjkjjkdfkjfdkjv'
             ]);
        });

    Route::group(['middleware' => 'auth:web'], function () {
        Route::get('logout', [AuthController::class,'logout'])->name('admin.logout');
        Route::get('home', [MainController::class,'index'])->name('admin.home');
        Route::resource('areas', AreaController::class);
        Route::resource('bills', BillController::class);
        Route::get('bills/print/{id}', [BillController::class,'print'])->name('bill.print');
        Route::get('bill-area', [BillController::class,'billArea'])->name('bill.area');
    });
  });

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
