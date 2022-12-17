<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Tracker;
use App\Models\Assignee;
use App\Models\Assigner;
use App\Models\Category;
use App\Models\Reporter;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DepartmentRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Requests\Admin\AdminTicketRequest;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\RegisterRequest;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->dashboard();
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
     * Store a newly create resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
    }

    public function storeTicket(AdminTicketRequest $request)
    {
        $forTicket = $request->validated();

        $forTicket['status'] = 'open';
        $forTicket['assigned_by'] = Auth::user()->id;

        // ->only([
        //     'number', 'title', 'category',
        //     'department', 'description',
        //     'due_date', 'location', 'priority',
        //     'reported_by', 'reporter_email'
        // ]);

        // dd($forTicket);
        $created_ticket = Ticket::create($forTicket);

        $createTicketID = $created_ticket->id;

        /*
        A Ticket has:
            > Reporter - issue reporter
            > Tracker - reference number
            > Tags
            > Statuses - Open `if admin, new if guest
        */

        $randRef = fake()->numberBetween(1000, 90000);

        Tracker::create([
            'reference_code' => "tr-{$randRef}",
            'tickets_id' => $createTicketID,
        ]);

        return redirect()
            ->route(
                'admin.tickets.view',
                ['status' => 'new']
            );
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

    public function login()
    {
        return view('authentication.login');
    }

    public function register()
    {
        return view('authentication.register');
    }

    public function createTicket()
    {
        $departments = Department::all();
        $categories = Category::all();

        $staffRole = Role::where('name', 'staff')
            ->first()
            ->id;

        $userRole = Role::where('name', 'user')
            ->first()
            ->id;

        $staffs = User::where('role_id', $staffRole)
            ->get();

        $users = User::where('role_id', $userRole)
            ->get();

        $ticketNumber = Ticket::getTicketNumber();
        return view(
            'admin.tickets.create_tickets',
            compact(
                'ticketNumber',
                'categories',
                'departments',
                'staffs',
                'users'
            )
        );
    }

    public function dashboard()
    {
        // $tickets = Ticket::all();
        // return view('admin.tickets.all', compact('tickets'));

        // Alert::alert('Title', 'Message', 'Type');

        return view('admin.tickets.dashboard');
    }

    function viewTickets($status = 'new')
    {
        $tickets = [];

        switch ($status) {
            case ('new'):
                $tickets = Ticket::where('status', 'new')
                    ->get();
                session(['status' => 'New']);
                break;
            case ('open'):
                $tickets = Ticket::where('status', 'open')
                    ->get();
                session(['status' => 'Open']);
                break;
            case ('closed'):
                $tickets = Ticket::where('status', 'closed')
                    ->get();
                session(['status' => 'Closed']);
                break;
            case ('overdue'):
                $tickets = Ticket::whereBetween('created_at', [
                    '2022-11-04 17:39:52',
                    '2022-11-22 17:38:28'
                ])->get();

                session(['status' => 'Overdue']);
                break;
        }
        // $tickets = Ticket::all()
        //     ->tracker()->get();

        $newCount = Ticket::where('status', 'new')
            ->get()
            ->count();

        $openCount = Ticket::where('status', 'open')
            ->get()
            ->count();

        $closedCount = Ticket::where(['status' => 'closed'])
            ->get()
            ->count();

        $categories = Category::all();

        $staffRole = Role::where('name', 'staff')
            ->first()
            ->id;

        $userRole = Role::where('name', 'user')
            ->first()
            ->id;

        $staffs = User::where('role_id', $staffRole)
            ->get();

        $staffs = User::where('role_id', $staffRole)
            ->get();

        $users = User::where('role_id', $userRole)
            ->get();

        return view(
            'admin.tickets.all_tickets',
            compact(
                'tickets',
                'newCount',
                'openCount',
                'closedCount',
                'categories',
                'staffs',
                'users'
            )
        );
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

    public function loginAccount(LoginRequest $request)
    {
        dd($request->email);
    }

    public function manageAccounts($type = 'admin')
    {
        $roleToGet = 'admin';

        /* The sessions are used in theview for listing available
        accounts, more specifically in the tabs for selecting
        between admins staff accounts
        */
        switch (Str::lower($type)) {
            case ('admin'):
                session(['for-admins' => true]);
                session(['for-staff' => false]);
                session(['for-users' => false]);

                $roleToGet = 'admin';
                break;

            case ('staff'):
                session(['for-staff' => true]);
                session(['for-admins' => false]);
                session(['for-users' => false]);

                $roleToGet = 'staff';
                break;

            case ('user'):
                session(['for-staff' => false]);
                session(['for-admins' => false]);
                session(['for-users' => true]);

                $roleToGet = 'user';
                break;

            default:
                session(['for-admins' => true]);
                session(['for-staff' => false]);
                session(['for-users' => false]);
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

    public function createAccount(Request $request)
    {
        return dd($request);
    }

    public function ticketSettings()
    {
        return view('admin.tickets.settings');
    }

    public function editTicket(Ticket $ticket)
    {
        $departments = Department::all();
        $categories = Category::all();
        $staff = User::where('role_id', 2)->get();

        $ticketNumber = Ticket::getTicketNumber();
        return view(
            'admin.tickets.update_ticket',
            [
                'ticket' => $ticket,
                'ticketNumber' => $ticketNumber,
                'categories' => $categories,
                'departments' => $departments,
                'staff' => $staff
            ]
        );

        return view('update');
    }
}
