<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\DepartmentsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Staff\ProfileController as StaffProfileController;

Route::fallback(function () {         //redirect all 404 to the landing page
    return view('landing_page');
});

Route::get('/redirect', function () {
    $role = Auth::user()->role_id;
    return $role;
});

Route::get('logout', function () {
    Session::flush();

    return redirect()
        ->route('login');
});

// Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(
//     function () {
//
// Admin controller
//
Route::middleware(['auth'])->group(
    function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('admin/create_ticket', 'createTicket')->name('admin.create_ticket');
            Route::get('admin/ticket/settings', 'ticketSettings')->name('admin.ticket.settings');
            Route::post('admin/tickets/store', 'storeTicket')->name('admin.tickets.store');
            Route::get('admin/tickets/show/{ticket}', 'editTicket')->name('admin.tickets.edit');
            Route::post('admin/tickets/show/{ticket?}', 'updateTicket')->name('admin.tickets.update');
            Route::get('admin/tickets/view/{status?}', 'viewTickets')->name('admin.tickets.view');
            Route::get('admin/dashboard', 'dashboard')->name('admin.dashboard');

            //Authentication
            Route::get('admin/auth/login', 'login')->name('admin.auth.login');
            Route::get('admin/auth/register', 'register')->name('admin.auth.register');
            Route::post('admin/auth/login_account', 'loginAccount')->name('admin.auth.login_account');
            Route::post('admin/auth/register_account', 'registerAccount')->name('admin.auth.register_account');

            //Accounts
            Route::get('admin/manage/accounts/view/{type?}', 'manageAccounts')->name('admin.accounts.view');
            Route::get('admin/manage/accounts/create', 'createAccountView')->name('admin.accounts.create');
            Route::post('admin/manage/accounts/create', 'createAccount')->name('admin.accounts.create');
        });

        Route::resource('admin', AdminController::class)->names([
            'index' => 'admin.home',
            'create' => 'admin.create',
            'store' => 'admin.store',
            'update' => 'admin.update',
            'destroy' => 'admin.delete',
        ])->parameters(['admin' => 'ticket']);
        //
        // Admin controller - END
        //
        //     }
        // );
    }
);

Route::controller(DepartmentsController::class)->group(function () {
    Route::get('admin/manage/department/create', 'create')->name('admin.departments.create');
    Route::post('admin/manage/department/store', 'store')->name('admin.departments.store');
    Route::get('admin/manage/department/edit/{department}', 'edit')->name('admin.departments.edit');
    Route::get('admin/manage/department/all', 'index')->name('admin.departments.index');
    Route::get('admin/manage/department/show/{category}', 'show')->name('admin.departments.show');
    Route::patch('admin/manage/department/update/{department}', 'update')->name('admin.departments.update');
});

Route::controller(ProfileController::class)->group(function () {
    Route::get('admin/manage/profile/show', 'index')->name('admin.profile.show');
    Route::post('admin/manage/department/store', 'store')->name('admin.profile.store');
    Route::patch('admin/manage/department/update/{department}', 'update')->name('admin.profile.update');
});

Route::controller(CategoriesController::class)->group(function () {
    Route::get('admin/manage/categories/create', 'create')->name('admin.categories.create');
    Route::post('admin/manage/categories/store', 'store')->name('admin.categories.store');
    Route::get('admin/manage/categories/edit/{category}', 'edit')->name('admin.categories.edit');
    Route::get('admin/manage/categories/categories/all', 'index')->name('admin.categories.index');
    Route::get('admin/manage/categories/show/{category}', 'show')->name('admin.categories.show');
    Route::patch('admin/manage/categories/update/{category}', 'update')->name('admin.categories.update');
});

//
// Staff controller
//
Route::controller(StaffController::class)->group(function () {
    Route::get('staff/dashboard', 'dashboard')->name('staff.dashboard');
    Route::get('staff/profile', 'profile')->name('staff.profile');
    Route::get('staff/tickets', 'tickets')->name('staff.tickets');
    Route::get('staff/tickets/view/{status?}', 'viewTickets')->name('staff.tickets.view');
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
    Route::get('guest/ticket/create', 'createTicket')->name('guest.ticket');
    Route::get('guest/reference/enter', 'enterReference')->name('guest.reference.enter');
    Route::post('guest/reference/track/', 'referenceTicket')->name('guest.reference.track');
    Route::post('guest/ticket/store', 'storeTicket')->name('guest.tickets.store');
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
