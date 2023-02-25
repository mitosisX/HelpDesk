<?php

namespace App\Http\Controllers\Manager;

use DateTime;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Tracker;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Queries\SpecialQueries;
use Illuminate\Support\Facades\DB;
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

    public function manageTickets(Ticket $ticket)
    {
        $category = Category::find($ticket->categories_id)->first();
        $department = User::find($ticket->reported_by)->first();

        return view(
            'manager.tickets.view_ticket',
            compact('ticket', 'category', 'department')
        );
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

    public function updateTicket(Ticket $ticket, Request $request)
    {
        $data = $request->all();
        $data['assigned_by'] = Auth::user()->id;
        $data['status'] = 'open';

        $ticket->update($data);

        return redirect()->route('manager.tickets.view');
    }

    public function jsonTicketStats()
    {
        $counter = SpecialQueries::ticketCounter();

        return response()
            ->json([
                'new' => $counter['newCount'],
                'open' => $counter['openCount'],
                'closed' => $counter['closedCount']
            ]);
    }

    public function jsonPriorityStats()
    {
        $low = Ticket::where('priority', 'Low')
            ->count();

        $medium = Ticket::where('priority', 'Medium')
            ->count();

        $high = Ticket::where('priority', 'High')
            ->count();

        return response()
            ->json([
                'low' => $low,
                'medium' => $medium,
                'high' => $high
            ]);
    }

    private function templateEloStats($month)
    {
        return Ticket::join('users', 'tickets.reported_by', '=', 'users.id')
            ->whereMonth('tickets.created_at', '=', $month);
    }

    public function stats()
    {
        $tickets = Ticket::whereMonth('created_at', now()->month)
            ->with('reporter.department')
            ->get()
            ->groupBy(function ($ticket) {
                return $ticket->reporter->department->name;
            })
            ->map(function ($tickets) {
                return $tickets->count();
            })
            ->toArray();

        dd($tickets);
    }

    public function ticketLocationStats()
    {
        $month = date('m');

        $ticketsByLocation = $this->templateEloStats($month)
            ->select('users.location', DB::raw('COUNT(*) as count'))
            ->groupBy('users.location')
            ->get();

        $locations = $ticketsByLocation->pluck('location');
        $countByLocation = $ticketsByLocation->pluck('count');

        return response()
            ->json([
                'locations' => $locations,
                'count' => $countByLocation,
                'total' => $countByLocation->sum()
            ]);
    }
}
