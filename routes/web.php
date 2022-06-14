<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackAdmin; 

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
    return redirect()->route('backadmin.auth.index');
});


Route::name('backadmin.')->group(function() {
    Route::get('login', [BackAdmin\LoginController::class, 'index'])->name('auth.index'); 
    Route::post('login', [BackAdmin\LoginController::class, 'login'])->name('auth.login');
    Route::get('logout', [BackAdmin\LoginController::class, 'logout'])->name('auth.logout'); 
     
    Route::middleware('auth')->group(function() {
        Route::resources([
            'users' => BackAdmin\UserController::class, 
            'account' => BackAdmin\AccountController::class,
            'produk' => BackAdmin\ProdukController::class,
            'transaction' => BackAdmin\TransactionController::class,
            'point' => BackAdmin\PointController::class,
            'report' => BackAdmin\ReportController::class,
             
        ]); 
        Route::post('users/logo', [BackAdmin\UserController::class, 'logos'])->name('users.logo');
        Route::get('dashboard', [BackAdmin\DashboardController::class, 'index'])->name('dashboard'); 
       
        Route::prefix('s2opt')->name('s2Opt.')->group(function () {  
            Route::get('accounts', [BackAdmin\AccountController::class, 'getS2Options'])->name('accounts');
            Route::get('desc', [BackAdmin\TransactionController::class, 'getS2Options'])->name('descs');
            Route::get('debits', [BackAdmin\TransactionController::class, 'getS21ptions'])->name('debits');
       
        });
        
        Route::prefix('s2init')->name('s2Init.')->group(function () {  
            Route::get('edit-accounts', [BackAdmin\AccountController::class,'getS2Init'])->name('edit-accounts');
            Route::get('edit-desc', [BackAdmin\TransactionController::class,'getS2Init'])->name('edit-descs');
            Route::get('edit-debits', [BackAdmin\TransactionController::class,'getS22nit'])->name('edit-debits');

        });
    });
});