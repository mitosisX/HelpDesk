<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Staff\StaffController;

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

//
// Staff controller
//
Route::controller(StaffController::class)->group(function(){
    Route::get('staff/dashboard', 'dashboard')->name('staff.dashboard');  
    Route::get('staff/profile', 'profile')->name('staff.profile');  
    Route::get('staff/tickets', 'tickets')->name('staff.tickets');  
    Route::post('staff/profile/store', 'profileSave')->name('staff.profile.store');  
});

Route::resource('staff', StaffController::class)->names([
    'index' => 'staff.home',
    'create' => 'staff.create',
    'store' => 'staff.store',
    'update' => 'staff.update',
    'destroy' => 'staff.delete',
]);
//
// Staff controller - END
//

