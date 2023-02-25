<?php

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\DepartmentsController;
use App\Http\Controllers\Admin\LocationController;

Route::fallback(function () {         //redirect all 404 to the landing page
    return redirect()
        ->route('login');
});

Route::get('/redirect', function () {
    $role = Auth::user()->role_id;
    return $role;
});

Route::get('register', function () {
    return redirect()->route('login');
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
        Route::controller(ManagerController::class)->group(function () {
            Route::get('manager/ticket/settings', 'ticketSettings')->name('manager.ticket.settings');
            Route::get('manager/tickets/show/{ticket}', 'editTicket')->name('manager.tickets.edit');
            Route::post('manager/tickets/show/{ticket?}', 'updateTicket')->name('manager.tickets.update');
            Route::get('manager/tickets/view/{status?}', 'viewTickets')->name('manager.tickets.view');
            Route::get('manager/dashboard', 'dashboard')->name('manager.dashboard');

            //Authentication
            Route::get('manager/auth/login', 'login')->name('manager.auth.login');
            Route::get('manager/auth/register', 'register')->name('manager.auth.register');
            Route::post('manager/auth/login_account', 'loginAccount')->name('manager.auth.login_account');
            Route::post('manager/auth/register_account', 'registerAccount')->name('manager.auth.register_account');

            Route::get('manager/tickets/manage/{ticket}', 'manageTickets')->name('manager.ticket.manage');
            Route::get('manager/tickets/assign/{ticket?}', 'assignTicket')->name('manager.tickets.assign');
            Route::post('manager/tickets/update/{ticket?}', 'updateTicket')->name('manager.tickets.update');
            Route::get('manager/tickets/stats/json', 'jsonTicketStats')->name('manager.tickets.stats.json');
            Route::get('manager/tickets/priority/json', 'jsonPriorityStats')->name('manager.tickets.priority.json');

            Route::get('manager/ticket/stats/locations/json', 'ticketLocationStats')->name('manager.ticket.stats.locations.json');
            Route::get('manager/ticket/stats/departments/json', 'ticketDepartmentsStats')->name('manager.ticket.stats.departments.json');
            Route::get('stats', 'stats');
        });

        Route::resource('manager', ManagerController::class)->names([
            'index' => 'manager.home',
            'create' => 'manager.create',
            'store' => 'manager.store',
            'update' => 'manager.update',
            'destroy' => 'manager.delete',
        ])->parameters(['admin' => 'ticket']);
        //
        // Admin controller - END
        //
        //     }
        // );

        Route::controller(AdminController::class)->group(function () {
            Route::post('admin/tickets/store', 'storeTicket')->name('admin.tickets.store');
            Route::get('admin/manage/accounts/view/{type?}', 'manageAccounts')->name('admin.accounts.view');
            Route::get('admin/manage/accounts/create', 'createAccountView')->name('admin.accounts.create');

            Route::get('log', 'test');
            Route::get('admin/tickets/create', 'createTicket')->name('admin.tickets.create');
        });

        Route::controller(AccountController::class)->group(function () {
            Route::post('manager/account/staff/create', 'satffCreate')
                ->name('account.staff.create');

            Route::post('manager/account/manager/create', 'adminCreate')
                ->name('account.manager.create');

            Route::post('manager/account/user/create', 'userCreate')
                ->name('account.user.store');

            Route::post('admin/manage/accounts/create', 'userCreate')->name('admin.accounts.create');
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

        Route::controller(LocationController::class)->group(function () {
            Route::get('admin/manage/location/create', 'create')->name('admin.locations.create');
            Route::post('admin/manage/location/store', 'store')->name('admin.locations.store');
            Route::get('admin/manage/location/edit/{category}', 'edit')->name('admin.locations.edit');
            Route::get('admin/manage/location/all', 'index')->name('admin.locations.index');
            Route::get('admin/manage/location/show/{locations}', 'show')->name('admin.locations.show');

            Route::post('admin/manage/location/store/json', 'store')->name('admin.locations.store.json');
            Route::post('admin/manage/location/update/json/{id?}', 'updateLocationsJson')->name('admin.locations.update.json');
            Route::delete('admin/manage/location/destroy/json/{locations?}', 'deleteLocationJson')->name('admin.locations.destroy.json');
        });
    }
);


Route::controller(ProfileController::class)->group(function () {
    Route::get('manager/manage/profile/show', 'index')->name('manager.profile.show');
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
    Route::get('staff/tickets/assign/{ticket?}', 'assignTicket')->name('staff.tickets.assign');
    Route::post('staff/tickets/update/{ticket?}', 'updateTicket')->name('staff.tickets.update');

    Route::get('staff/dashboard', 'dashboard')->name('staff.dashboard');
    Route::get('staff/tickets', 'tickets')->name('staff.tickets');
    Route::get('staff/tickets/view/{status?}', 'viewTickets')->name('staff.tickets.view');
    Route::get('staff/tickets/manage/{ticket}', 'manageTickets')->name('staff.ticket.manage');
    Route::post('staff/tickets/manage/markdone/json', 'markTicketDone')->name('staff.ticket.manage.markdone');
    Route::get('staff/manage/profile/{id}', 'viewProfile')->name('staff.manage.profile');
    Route::post('staff/manage/profile/store', 'profileUpdate')->name('staff.profile.update');
    Route::get('staff/ticket/manage/messages/{ticket}', 'getMessages')->name('staff.ticket.messages');
    Route::post('staff/tickets/message/send/json', 'sendMessage')->name('staff.ticket.message.send');
});

//
// user controller
//
Route::middleware(['auth'])->group(function () {
    Route::controller(GuestController::class)->group(function () {
        Route::get('user/tickets/create', 'createTicket')->name('user.tickets.create');
        Route::get('user/tickets/view/{status}', 'allTickets')->name('user.tickets.view');
        Route::get('user/tickets/track/{ticket}', 'referenceTicket')->name('user.tickets.reference.track');
        Route::post('user/ticket/store', 'storeTicket')->name('user.tickets.store');
        Route::get('user/ticket/messages/{ticket}', 'getMessages')->name('user.ticket.message');
        Route::post('user/tickets/manage/markdone/json', 'markTicketDone')->name('user.ticket.manage.markdone');
        Route::post('user/tickets/message/send/json', 'sendMessage')->name('user.ticket.message.send');
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
