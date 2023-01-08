<?php

namespace App\Http\Controllers\Guest;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Tracker;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Guest\GuestTicketRequest;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->createTicket();
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
        dd($request->department);
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

    public function createTicket()
    {
        $departments = Department::all();
        $categories = Category::all();
        $staff = User::where('role_id', 2)->get();

        $ticketNumber = Ticket::getTicketNumber();
        return view(
            'guest.create_ticket',
            compact('categories')
        );
    }

    public function enterReference()
    {
        $ref = session('ref_code');
        if ($ref) notify()->success("reference number: {$ref}");
        return view('guest.enter_ticket_reference');
    }

    public function referenceTicket(Ticket $ticket)
    {
        return view(
            'guest.track_ticket',
            compact('ticket')
        );
    }

    public function storeTicket(GuestTicketRequest $request)
    {
        $forTicket = $request->validated();
        $forTicket['status'] = 'new';
        $forTicket['reported_by'] = Auth::user()->id;

        $created_ticket = Ticket::create($forTicket);

        $createTicketID = $created_ticket->id;

        $ref = fake()->numberBetween(1000, 90000);
        // $ref = "tr-{$randRef}";

        // Tracker::create([
        //     'reference_code' => $ref,
        //     'tickets_id' => $createTicketID,
        // ]);

        return redirect()
            ->route(
                'user.tickets.view'
            );
    }

    public function allTickets()
    {
        $GetTickets = Ticket::where(function ($query) {
            $query->where('reported_by', Auth::user()->id)
                ->where('status', '!=', 'closed');
        });

        $resolvedTickets = Ticket::where(function ($query) {
            $query->where('reported_by', Auth::user()->id)
                ->where('status', '=', 'closed');
        });

        $openCount = $GetTickets->count();

        $closedCount = $resolvedTickets->count();

        $unresolvedTickets = Ticket::where(function ($query) {
            $query->where('reported_by', Auth::user()->id)
                ->where('status', '!=', 'closed');
        })->get();


        return view(
            'guest.all_tickets',
            compact('unresolvedTickets', 'openCount', 'closedCount')
        );
    }
}
