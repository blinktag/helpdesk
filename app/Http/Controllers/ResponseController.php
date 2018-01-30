<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Response;
use Illuminate\Http\Request;
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
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewResponse $request)
    {
        $ticket = Ticket::where('user_id', auth()->user()->id)->find($request->ticket_id);
        $ticket->responses()->create([
            'content' => request('body'),
            'user_id' => auth()->user()->id,
            'from'    => request()->ip()
        ]);

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
