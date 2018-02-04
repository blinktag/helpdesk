<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Response;
use Illuminate\Http\Request;
use App\Services\CreateResponse;
use App\Events\TicketReplyCreated;
use App\Http\Requests\StoreNewResponse;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {

    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreNewResponse  $request
     * @param \App\Services\CreateResponse  $response_service
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewResponse $request, CreateResponse $response_service)
    {
        $ticket = Ticket::where('user_id', auth()->user()->id)->find($request->ticket_id);

        $response = $response_service->make($request, $ticket);

        event(new TicketReplyCreated($response));

        return redirect(route('ticket.show', $ticket->id))->withSuccess('Your reply has been added to this ticket');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function edit(Response $response)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Response $response)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(Response $response)
    {
        //
    }
}
