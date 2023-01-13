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


    function viewTicdkets($status = 'open')
    {
        // $tickets = collect();

        switch ($status) {
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

        return view(
            'staff.tickets.all_tickets',
            compact(
                'ticketss'
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
        return view('manager.tickets.update_ticket');
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
        $tickets = collect();

        switch ($status) {
            case ('new'):
                $tickets = Ticket::where('status', '=', 'new')
                    ->orderBy('id', 'desc')
                    ->get();
                session(['status' => 'New']);
                break;

            case ('open'):
                $tickets = Ticket::where('status', '=', 'open')
                    ->orderBy('id', 'desc')
                    ->where('assigned_to', Auth::user()->id)
                    ->get();
                session(['status' => 'Open']);
                break;

            case ('closed'):
                $tickets = Ticket::where('status', '=', 'closed')
                    ->where('assigned_to', Auth::user()->id)
                    ->orderBy('id', 'desc')
                    ->get();
                session(['status' => 'Closed']);
                break;

            case ('overdue'):
                $tickets = Ticket::where('status', '!=', 'new')
                    ->where('status', '!=', 'closed')
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
                    })
                    ->get();

                session(['status' => 'Overdue']);
                break;
        }

        return view(
            'staff.all_tickets',
            compact('tickets')
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
            'staff.assign_ticket',
            compact('staffs', 'users', 'ticket', 'categories')
        );
    }

    public function updateTicket(Ticket $ticket, Request $request)
    {
        $data = $request->all();
        $data['assigned_by'] = Auth::user()->id;
        $data['status'] = 'open';

        $ticket->update($data);

        return redirect()->route('staff.tickets.view');
    }
}
