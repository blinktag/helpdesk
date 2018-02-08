<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class DepartmentTreeResource extends Resource
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
            'name' => $this->name,
            'children' => [
                ['name' => 'Open', 'href' => route('admin.browse.department', ['id' => $this->id, 'status' => 'open'])],
                ['name' => 'Waiting on Client', 'href' => route('admin.browse.department', ['id' => $this->id, 'status' => 'hold'])],
                ['name' => 'Closed', 'href' => route('admin.browse.department', ['id' => $this->id, 'status' => 'closed'])]
            ]
        ];
    }
}
