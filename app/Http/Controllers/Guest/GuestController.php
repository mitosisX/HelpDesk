<?php

namespace App\Http\Controllers\Guest;

use App\Models\User;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Tracker;
use App\Models\Category;
use App\Models\Reporter;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Guest\GuestTicketRequest;
use App\Http\Requests\Guest\TrackTicketRequest;
use Illuminate\Contracts\Database\Eloquent\Builder;

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
            [
                'ticketNumber' => $ticketNumber,
                'categories' => $categories,
                'departments' => $departments,
                'staff' => $staff
            ]
        );
    }

    public function enterReference()
    {
        $ref = session('ref_code');
        if ($ref) notify()->success("reference number: {$ref}");
        return view('guest.enter_ticket_reference');
    }

    public function referenceTicket(TrackTicketRequest $request)
    {
        session(['ref' => $request->validated()]);

        $ref = $request->reference_code;
        $ticket = Ticket::whereHas('tracker', function (Builder $query) {
            $query->where('reference_code', session('ref'));
        })->first();
        // /dd($ticket);

        return view(
            'guest.tracking_status',
            compact('ticket')
        );
    }

    public function storeTicket(GuestTicketRequest $request)
    {
        $forTicket = $request->validated();
        $forTicket['status'] = 'open';
        $forTicket['assigned_to'] = '2';
        $forTicket['assigned_by'] = '1';

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

        Reporter::create([
            'name' => $forTicket['reported_by'],
            'email' => $forTicket['reporter_email'],
            'tickets_id' => $createTicketID,
            'location' => $forTicket['location']
        ]);

        $randRef = fake()->numberBetween(1000, 90000);
        $ref = "tr-{$randRef}";

        Tracker::create([
            'reference_code' => $ref,
            'tickets_id' => $createTicketID,
        ]);

        return redirect()
            ->route(
                'guest.reference.enter'
            )->with('ref_code', $ref);
    }
}
