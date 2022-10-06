<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminTicketRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminTicketRequest $request)
    {
        $request->validated();

        $forTicket = $request->safe()->only(['number','title','category',
        'department','description',
        'due_date','location','priority'
        ]);

        $forTicket = $request->safe()->only(['number','title','category',
        'department','description',
        'due_date','location','priority'
        ]);

        $forTicket = $request->safe()->only(['number','title','category',
        'department','description',
        'due_date','location','priority'
        ]);

        $created_ticket = Ticket::create($forTicket);
        $id = $created_ticket->id;

        return $id;
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

    public function createTicket(){
        $tickets = Ticket::all();
        $ticketNumber = Ticket::getTicketNumber();
        return view('admin.create_ticket',[
            'tickets'=>$tickets,
            'ticketNumber' => $ticketNumber
        ]);
    }

    public function dashboard(){
        return view('admin.dashboard');
    }
}
