<?php

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\DepartmentsController;
use App\Http\Controllers\Staff\ProfileController as StaffProfileController;

Route::fallback(function () {         //redirect all 404 to the landing page
    return redirect()
        ->route('login');
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
            Route::get('admin/tickets/create', 'createTicket')->name('admin.tickets.create');
            Route::get('admin/ticket/settings', 'ticketSettings')->name('admin.ticket.settings');
            Route::post('admin/tickets/store', 'storeTicket')->name('admin.tickets.store');
            Route::get('admin/tickets/show/{ticket}', 'editTicket')->name('admin.tickets.edit');
            Route::post('admin/tickets/show/{ticket?}', 'updateTicket')->name('admin.tickets.update');
            Route::get('admin/tickets/view/{status?}', 'viewTickets')->name('admin.tickets.view');
            Route::get('admin/tickets/assign/{ticket?}', 'assignTicket')->name('admin.tickets.assign');
            Route::post('admin/tickets/update/{ticket?}', 'updateTicket')->name('admin.tickets.update');
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

        Route::controller(AccountController::class)->group(function () {
            Route::post('admin/account/staff/create', 'satffCreate')
                ->name('account.staff.create');

            Route::post('admin/account/admin/create', 'adminCreate')
                ->name('account.admin.create');

            Route::post('admin/account/user/create', 'userCreate')
                ->name('account.user.store');
        });

        Route::controller(DepartmentsController::class)->group(function () {
            Route::get('admin/manage/department/create', 'create')->name('admin.departments.create');
            Route::post('admin/manage/department/store', 'store')->name('admin.departments.store');
            Route::get('admin/manage/department/edit/{department}', 'edit')->name('admin.departments.edit');
            Route::get('admin/manage/department/all', 'index')->name('admin.departments.index');
            Route::get('admin/manage/department/show/{category}', 'show')->name('admin.departments.show');
            Route::patch('admin/manage/department/update/{department}', 'update')->name('admin.departments.update');

            Route::post('admin/manage/department/store/json', 'store')->name('admin.departments.store.json');
            Route::post('admin/manage/department/remove/{department}', 'delete')->name('admin.departments.destroy');
            Route::post('admin/manage/departments/update/json/{id?}', 'updateDepartmentJson')->name('admin.department.update.json');
            Route::delete('admin/manage/departments/destroy/json/{department?}', 'deleteDepartmentJson')->name('admin.department.destroy.json');
        });

        Route::controller(CategoriesController::class)->group(function () {
            Route::get('admin/manage/categories/create', 'create')->name('admin.categories.create');
            Route::post('admin/manage/categories/store', 'store')->name('admin.categories.store');
            Route::get('admin/manage/categories/edit/{category}', 'edit')->name('admin.categories.edit');
            Route::get('admin/manage/categories/all', 'index')->name('admin.categories.index');
            Route::get('admin/manage/categories/show/{category}', 'show')->name('admin.categories.show');

            Route::post('admin/manage/category/store/json', 'store')->name('admin.category.store.json');
            Route::post('admin/manage/category/update/json/{id?}', 'updateCategoryJson')->name('admin.category.update.json');
            Route::delete('admin/manage/category/destroy/json/{category?}', 'deleteCategoryJson')->name('admin.category.destroy.json');
        });
    }
);


Route::controller(ProfileController::class)->group(function () {
    Route::get('admin/manage/profile/show', 'index')->name('admin.profile.show');
    // Route::post('admin/manage/department/store', 'store')->name('admin.profile.store');
    // Route::patch('admin/manage/department/update/{department}', 'update')->name('admin.profile.update');
});

//
// Staff controller
//

Route::resource('staff', StaffController::class)->names([
    'index' => 'staff.index',
    'create' => 'staff.create',
    'store' => 'staff.store',
    'update' => 'staff.update',
    'destroy' => 'staff.delete',
]);

Route::controller(StaffController::class)->group(function () {
    Route::get('staff/dashboard', 'dashboard')->name('staff.dashboard');
    Route::get('staff/profile', 'profile')->name('staff.profile');
    Route::get('staff/tickets', 'tickets')->name('staff.tickets');
    Route::get('staff/tickets/view/{status?}', 'viewTickets')->name('staff.tickets.view');
    Route::get('staff/tickets/manage/{ticket}', 'manageTickets')->name('staff.ticket.manage');
    Route::post('staff/tickets/manage/markdone/json', 'markTicketDone')->name('staff.ticket.manage.markdone');
    Route::post('staff/profile/store', 'profileSave')->name('staff.profile.store');
});

//
// Staff controller - END
//

//
// user controller
//
Route::middleware(['auth'])->group(function () {
    Route::controller(GuestController::class)->group(function () {
        Route::get('user/tickets/create', 'createTicket')->name('user.tickets.create');
        Route::get('user/tickets/view/{status}', 'allTickets')->name('user.tickets.view');
        Route::get('user/tickets/track/{ticket}', 'referenceTicket')->name('user.tickets.reference.track');
        Route::post('user/ticket/store', 'storeTicket')->name('user.tickets.store');
        Route::post('user/tickets/manage/markdone/json', 'markTicketDone')->name('user.ticket.manage.markdone');
    });

    Route::resource('user', GuestController::class)->names([
        'create' => 'user.create',
        'store' => 'user.store'
    ]);
});

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
