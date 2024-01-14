<?php

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

Route::middleware(['backend'])
    ->prefix('backend')
    ->name('backend.')
    ->namespace('Cpkm\Excel\Http\Controllers\Backend')->group(function(){
        Route::middleware(['auth:backend', 'admin.permission'])
            ->prefix('excel')
            ->name('excel.')
            ->group(function () {
                /* 資料匯入管理 */
                Route::resource('import', 'Excel\ImportController');
            });
    });