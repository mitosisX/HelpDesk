<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Tracker;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Authentication\RegisterRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    //Auth
    public function registerAccount(RegisterRequest $request)
    {
        $request->validated();

        $details = $request->safe()->only(['email', 'password']);

        User::create([
            'email' => $details['email'],
            'name' => '',
            'role_id' => 2,
            'password' => $details['password']
        ]);

        return redirect()
            ->route('admin.home');
    }

    public function manageAccounts($type = 'admin')
    {
        $roleToGet = 'admin';

        /* The sessions are used in the view for listing available
        accounts, more specifically in the tabs for selecting
        between admins staff accounts
        */
        switch (Str::lower($type)) {
            case ('admin'):
                session(['account-type' => 'admins']);
                // session(['for-staff' => false]);
                // session(['for-users' => false]);

                $roleToGet = 'admin';
                break;

            case ('staff'):
                session(['account-type' => 'staff']);
                // session(['for-staff' => true]);
                // session(['for-admins' => false]);
                // session(['for-users' => false]);

                $roleToGet = 'staff';
                break;

            case ('user'):
                session(['account-type' => 'users']);
                // session(['for-staff' => false]);
                // session(['for-admins' => false]);
                // session(['for-users' => true]);

                $roleToGet = 'user';
                break;

            default:
                session(['account-type' => 'admins']);
                // session(['for-admins' => true]);
                // session(['for-staff' => false]);
                // session(['for-users' => false]);
                $roleToGet = 'admin';

                return redirect()
                    ->route('admin.accounts.view', ['type' => 'admin']);
                break;
        }

        $role = Role::where('name', $roleToGet)
            ->first()
            ->id;

        $users = User::where('role_id', $role)
            ->get();

        $departments = Department::all();

        return view(
            'admin.accounts.index',
            compact('users', 'departments')
        );
    }

    public function createAccountView()
    {
        $roles = Role::all();
        return view('admin.accounts.create', compact('roles'));
    }

    public function createTicket()
    {
        $departments = Department::all();
        $categories = Category::all();

        $userRole = Role::where('name', 'user')
            ->first()
            ->id;

        $users = User::where('role_id', $userRole)
            ->get();

        return view(
            'admin.tickets.create_tickets',
            compact(
                'categories',
                'departments',
                'users'
            )
        );
    }

    public function storeTicket(Request $request)
    {
        $forTicket = $request->all();
        $forTicket['status'] = 'new';
        $forTicket['reported_by'] = $request->reported_by;

        $created_ticket = Ticket::create($forTicket);

        // $createTicketID = $created_ticket->id;

        $ref = fake()->numberBetween(1000, 90000);
        // $ref = "tr-{$randRef}";

        // Tracker::create([
        //     'reference_code' => $ref,
        //     'tickets_id' => $createTicketID,
        // ]);

        return redirect()
            ->back()->with('ticket-created', true);
    }
}
