<?php

namespace App\Http\Controllers\Admin;

use App\Ticket;
use App\response;
use Illuminate\Http\Request;
use App\Services\CreateResponse;
use App\Events\TicketReplyCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewResponse;
use App\Http\Resources\ResponseResource;

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
     * Store a newly created response in storage.
     *
     * @param \App\Http\Requests\StoreNewResponse  $request
     * @param \App\Services\CreateResponse  $response_service
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewResponse $request, CreateResponse $response_service)
    {
        $ticket = Ticket::findOrFail($request->ticket_id);

        $response = $response_service->make($request, $ticket);

        event(new TicketReplyCreated($response));

        return redirect(route('admin.ticket.show', $ticket->id))->withSuccess('Your reply has been added to this ticket');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function show(Response $response)
    {
        return new ResponseResource($response);
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
        $response->content = $request->content;
        $response->save();

        return new ResponseResource($response->fresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(Response $response)
    {
        $response->delete();
        return response([], 200);
    }
}
