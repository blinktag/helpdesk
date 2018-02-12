<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TicketResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'subject'      => $this->subject,
            'user_id'      => $this->user_id,
            'last_reply'   => $this->last_reply->timestamp,
            'last_replier' => $this->last_replier,
            'responses'    => ResponseResource::collection($this->responses)
        ];
    }
}
