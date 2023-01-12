<?php

namespace App\Http\Controllers\Manager;

use DateTime;
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
use App\Http\Requests\Admin\AdminTicketRequest;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\RegisterRequest;

class ManagerController extends Controller
{
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
    }

    public function storeTicket(AdminTicketRequest $request)
    {
        $forTicket = $request->validated();

        $forTicket['status'] = 'open';
        $forTicket['comment'] = $request->all()['comment'];
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
            'reference_code' => $randRef,
            'tickets_id' => $createTicketID,
        ]);

        return redirect()
            ->route(
                'manager.tickets.view',
                ['status' => 'new']
            );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
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
            'manager.tickets.create_tickets',
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
        // return view('manager.tickets.all', compact('tickets'));

        // Alert::alert('Title', 'Message', 'Type');
        return view('manager.tickets.dashboard');
    }

    function viewTickets($status = 'new')
    {
        $tickets = [];

        switch ($status) {
            case ('new'):
                $tickets = Ticket::where('status', 'new')
                    ->orderBy('id', 'desc')
                    ->get();
                session(['status' => 'New']);
                break;
            case ('open'):
                $tickets = Ticket::where('status', 'open')
                    ->orderBy('id', 'desc')
                    ->get();
                session(['status' => 'Open']);
                break;
            case ('closed'):
                $tickets = Ticket::where('status', 'closed')
                    ->orderBy('id', 'desc')
                    ->get();
                session(['status' => 'Closed']);
                break;
            case ('overdue'):
                $tickets = Ticket::where('status', '!=', 'closed')
                    ->where('status', '!=', 'new')
                    ->orderBy('id', 'desc')
                    ->get()
                    ->filter(function ($value, $key) {
                        // Set the target date in the future
                        $target_date = $value->due_date;

                        // Get the current date and time
                        $current_date = new DateTime();

                        // Calculate the difference between the two dates
                        $difference = $current_date->diff(new DateTime($target_date));

                        if ($difference->days <= 2) {

                            return $value;
                        }
                        // Check if the difference is less than or equal to 2 days
                    });

                $tickts = $tickets->reject(function ($ticket) {
                    return $ticket->cancelled;
                });
                // ->all();

                // dd($tickets);

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
            'manager.tickets.all_tickets',
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

    public function createAccount(Request $request)
    {
        return dd($request);
    }

    public function ticketSettings()
    {
        return view('manager.tickets.settings');
    }

    public function editTicket(Ticket $ticket)
    {
        $departments = Department::all();
        $categories = Category::all();
        $staff = User::where('role_id', 2)->get();

        $ticketNumber = Ticket::getTicketNumber();
        return view(
            'manager.tickets.update_ticket',
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

    public function assignTicket(Ticket $ticket)
    {
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

        return view(
            'manager.tickets.assign_ticket',
            compact('staffs', 'users', 'ticket', 'categories')
        );
    }

    public function updateTicket(Ticket $ticket, AdminTicketRequest $request)
    {
        $data = $request->validated();
        $data['assigned_by'] = Auth::user()->id;
        $data['status'] = 'open';

        $ticket->update($data);

        return redirect()->route('manager.tickets.view');
    }
}
