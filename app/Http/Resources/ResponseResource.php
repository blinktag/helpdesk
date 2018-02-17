<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ResponseResource extends Resource
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
            'ticket_id'    => $this->ticket_id,
            'author'       => $this->author->name,
            'author_type'  => $this->author_type,
            'gravatar_url' => $this->author->getGravatarUrl(),
            'content'      => $this->content,
            'from'         => $this->from,
            'created_at'   => $this->created_at->diffForHumans(),
            'attachments'  => AttachmentResource::collection($this->attachments)
        ];
    }
}
