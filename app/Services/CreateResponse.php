<?php

namespace App\Services;

use App\Ticket;
use App\Response;
use Illuminate\Http\Request;

class CreateResponse
{
    /**
     * Handle a response to a new ticket to keep controllers DRY
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Ticket $ticket
     * @return Response
     */
    public function make(Request $request, Ticket $ticket): Response
    {
        // Create response
        $response = $ticket->responses()->create([
            'content' => $request->get('body'),
            'user_id' => auth()->user()->id,
            'from'    => request()->ip()
        ]);

        // Add Attachment
        if ($request->hasFile('ticket_attachment')) {
            $upload = $request->file('ticket_attachment');

            $path = $upload->store('attachments');
            $attachment = $response->attachments()->create([
                'name'      => $upload->getClientOriginalName(),
                'mime_type' => $upload->getClientMimeType(),
                'size'      => $upload->getClientSize(),
                'location'  => $path
            ]);
        }

        return $response;
    }
}
