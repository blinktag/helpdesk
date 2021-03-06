<?php

namespace App\Http\Controllers\Admin;

use App\Note;
use App\User;
use App\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\NoteResource;

class NoteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $note = Note::create([
            'product_id'   => $request->product_id,
            'product_type' => $this->typeToModel($request->product_type),
            'content'      => $request->content,
            'admin_id'     => \Auth::id(),
            'priority'     => $request->priority
        ]);

        return new NoteResource($note);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        return new NoteResource($note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $this->validate($request, [
            'content'  => 'required',
            'priority' => 'required'
        ]);
        $note->priority = request('priority');
        $note->content = request('content');
        $note->save();

        return new NoteResource($note->fresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return response([], 200);
    }

    /**
     * List all notes for a given ticket
     *
     * @param Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function ticket(Ticket $ticket)
    {
        return NoteResource::collection($ticket->notes);
    }

    /**
     * List all notes for a given user
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function user(User $user)
    {
        return NoteResource::collection($user->notes);
    }

    /**
     *
     *
     * @param [type] $product
     * @return void
     */
    public function typeToModel($product)
    {
        $map = [
            'ticket' => Ticket::class,
            'user'   => User::class
        ];

        return $map[$product];
    }
}
