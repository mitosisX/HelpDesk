<?php

namespace App\Http\Controllers\Staff;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
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
        return $this->profile();
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
            ->route('staff.tickets.view');
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
        $tickets = [];

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
                $tickets = Ticket::where([
                    'status' => 'open',
                    'assigned_to' => Auth::user()->id
                ])
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
                $tickets = Ticket::whereBetween('created_at', [
                    '2022-11-04 17:39:52',
                    '2022-11-22 17:38:28'
                ])->get();

                session(['status' => 'Overdue']);
                break;
        }
        // $tickets = Ticket::all()
        //     ->tracker()->get();

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
                'tickets' => $tickets,
                'newCount' => $new,
                'openCount' => $open,
                'closedCount' => $closed
            ]
        );
    }
}
