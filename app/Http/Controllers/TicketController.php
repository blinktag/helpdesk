<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Department;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNewTicket;

class TicketController extends Controller
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
        return redirect('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return view('ticket.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewTicket $request)
    {
        // Create ticket
        $ticket = auth()->user()->tickets()->create([
            'department_id' => request('department_id'),
            'subject'      => request('subject'),
            'last_replier' => auth()->user()->name
        ]);

        // Create response
        $ticket->responses()->create([
            'content' => request('body'),
            'from'    => $request->ip(),
            'user_id' => auth()->user()->id
        ]);

        return redirect(route('ticket.show', $ticket->id))
                   ->withSuccess('Your ticket has been opened. A technician will respond shortly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $ticket = Ticket::where('user_id', auth()->user()->id)
                    ->findOrFail($request->id);
        return view('ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
