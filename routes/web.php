<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::fallback(function(){         //redirect all 404 to the landing page
    return view('landing_page');
});

//
// Admin controller
//
Route::controller(AdminController::class)->group(function(){
    Route::get('admin/create_ticket', 'createTicket')->name('admin.create_ticket');  
    Route::get('admin/dashboard', 'dashboard')->name('admin.dashboard');  
});

Route::resource('admin', AdminController::class)->names([
    'index' => 'admin.home',
    'create' => 'admin.create',
    'store' => 'admin.store',
    'update' => 'admin.update',
    'destroy' => 'admin.delete',
]);
//
// Admin controller - END
//

