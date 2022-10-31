<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Staff\StaffController;

Route::fallback(function () {         //redirect all 404 to the landing page
    return view('landing_page');
});

Route::get('/redirect', function () {
    $role = Auth::user()->role_id;
    return $role;
});

// Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(
//     function () {
//
// Admin controller
//
Route::controller(AdminController::class)->group(function () {
    Route::get('admin/create_ticket', 'createTicket')->name('admin.create_ticket');
    Route::post('admin/tickets/store', 'storeTicket')->name('admin.tickets.store');
    Route::get('admin/tickets/view/{status}', 'viewTickets')->name('admin.tickets.view');
    Route::get('admin/dashboard', 'dashboard')->name('admin.dashboard');

    //Authentication
    Route::get('admin/auth/login', 'login')->name('admin.auth.login');
    Route::get('admin/auth/register', 'register')->name('admin.auth.register');
    Route::post('admin/auth/login_account', 'loginAccount')->name('admin.auth.login_account');
    Route::post('admin/auth/register_account', 'registerAccount')->name('admin.auth.register_account');

    //Categories
    Route::get('admin/manage/categories/create', 'createCategories')->name('admin.categories.create');
    Route::post('admin/manage/categories/create', 'storeCategories')->name('admin.categories.store');
    Route::get('admin/manage/categories/edit/{category}', 'editCategories')->name('admin.categories.edit');
    Route::get('admin/manage/categories/all', 'allCategories')->name('admin.categories.index');
    Route::get('admin/manage/categories/show/{category}', 'showCategory')->name('admin.categories.show');
    Route::patch('admin//managecategories/update/{category}', 'updateCategory')->name('admin.categories.update');

    //Departments
    Route::get('admin/manage/departments/create', 'createDepartments')->name('admin.departments.create');
    Route::post('admin/manage/departments/create', 'storeDepartments')->name('admin.departments.store');
    Route::get('admin/manage/departments/edit/{department}', 'editDepartments')->name('admin.departments.edit');
    Route::get('admin/manage/departments/all', 'allDepartments')->name('admin.departments.index');
    Route::patch('admin/manage/departments/update/{department}', 'updateDepartments')->name('admin.departments.update');

    //Accounts
    Route::get('admin/manage/accounts/view/{type}', 'manageAccounts')->name('admin.accounts.view');
    Route::get('admin/manage/accounts/create', 'createAccountView')->name('admin.accounts.create');
    Route::post('admin/manage/accounts/create', 'createAccount')->name('admin.accounts.create');
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
//     }
// );
//
// Staff controller
//
Route::controller(StaffController::class)->group(function () {
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

//
// Guest controller
//
Route::controller(GuestController::class)->group(function () {
    Route::get('guest/ticket', 'createTicket')->name('guest.ticket');
    Route::get('guest/reference/enter', 'enterReference')->name('guest.reference.enter');
    Route::get('guest/track', 'trackTicket')->name('guest.track');
});

Route::resource('guest', GuestController::class)->names([
    'create' => 'guest.create',
    'store' => 'guest.store'
]);

//
// Staff controller - END
//
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
