<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class NoteResource extends Resource
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
            'id'         => $this->id,
            'author'     => $this->author->name,
            'created_at' => $this->created_at->timestamp,
            'ticket_id'  => $this->ticket_id,
            'priority'   => $this->priority,
            'content'    => $this->content
        ];
    }
}
