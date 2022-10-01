<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
    return view('landing_page');
});

Route::fallback(function(){         //redirect all 404 to the landing page
    return view('landing_page');
});

Route::resource('admin', AdminController::class)->names([
    'index' => 'admin.home',
    'create' => 'admin.create',
    'store' => 'admin.store',
    'update' => 'admin.update',
    'destroy' => 'admin.delete'
]);
