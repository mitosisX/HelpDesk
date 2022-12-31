<?php

namespace App\Http\Controllers\Staff;

use DateTime;
use App\Models\Role;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('staff.all_tickets');
    }


    function viewTicdkets($status = 'new')
    {
        $tickets = collect();

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
                $tickets = Ticket::where('status', '!=', 'new')
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
                    })
                    ->all();

                dd($tickets);

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
    public function show(Ticket $ticket)
    {
        return 2;
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
        return view('admin.tickets.update_ticket');
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

    public function dashboard()
    {
        return redirect()
            ->route('staff.index');
    }

    public function profile()
    {
        return view('staff.profile');
    }

    public function profileSave(Request $request)
    {
        return "saving";
    }

    public function tickets()
    {
        $new = Ticket::where('status', 'new')
            ->get()
            ->count();
        $open = Ticket::where('status', 'open')
            ->get()
            ->count();
        $closed = Ticket::where(['status' => 'closed'])
            ->get()
            ->count();

        $tickets = Ticket::where(
            'assigned_to',
            Auth::user()->id
        )->get();

        return view('staff.all_tickets', [
            'tickets' => $tickets,
            'newCount' => $new,
            'openCount' => $open,
            'closedCount' => $closed
        ]);
    }


    function viewTickets($status = 'new')
    {
        // $tickets = null;

        switch ($status) {
            case ('new'):
                $tickets = Ticket::where([
                    'status' => 'new',
                    'assigned_to' => Auth::user()->id
                ])
                    ->get();
                session(['status' => 'New']);
                break;
            case ('open'):
                $tickets = Ticket::where(
                    'status',
                    'open'
                )
                    ->where(
                        'assigned_to',
                        Auth::user()->id
                    )
                    ->get();
                session(['status' => 'Open']);
                break;
            case ('closed'):
                $tickets = Ticket::where([
                    'status' => 'closed',
                    'assigned_to' => Auth::user()->id
                ])
                    ->get();
                session(['status' => 'Closed']);
                break;
            case ('overdue'):
                $tickets = Ticket::where('status', '!=', 'new')
                    ->where('assigned_to', Auth::user()->id)
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

                session(['status' => 'Overdue']);
                break;
        }

        $new = Ticket::where([
            'status' => 'new',
            'assigned_to' => Auth::user()->id
        ])
            ->get()
            ->count();

        $open = Ticket::where([
            'status' => 'open',
            'assigned_to' => Auth::user()->id
        ])
            ->get()
            ->count();

        $closed = Ticket::where([
            'status' => 'closed',
            'assigned_to' => Auth::user()->id
        ])
            ->get()
            ->count();

        return view(
            'staff.all_tickets',
            [
                'tickets' => $tickets->all(),
                'newCount' => $new,
                'openCount' => $open,
                'closedCount' => $closed,
                'dueCount' => $tickets->count()
            ]
        );
    }

    public function manageTickets(Ticket $ticket)
    {
        $category = Category::find($ticket->categories_id)->first();
        $department = User::find($ticket->reported_by)->first();

        return view(
            'staff.view_ticket',
            compact('ticket', 'category', 'department')
        );
    }

    public function markTicketDone(Request $ticket)
    {
        Ticket::find($ticket->id)
            // ->first()
            ->update(['status' => 'closed']);

        return response()
            ->json(['success' => true]);
    }
}
