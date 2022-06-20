<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            "id"=>$this->resource->id,
            "title"=>$this->resource->department->name,
            "department"=>$this->resource->department->department->name,
            "description"=>$this->resource->description,
            "customer"=>$this->resource->agent->full_name,
            "status"=>$this->resource->status->name,
            "priority"=>$this->resource->priority->name,
            "priority_color"=>$this->resource->priority->color,
            "user"=>$this->resource->user->full_name,
            "created_at"=>$this->resource->created_at->diffForHumans(),

        ];
    }
}
