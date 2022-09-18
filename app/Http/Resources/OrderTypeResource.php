<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;

class OrderTypeResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getIdOrUuid(),
            'createdByUserId' => $this->createdByUserId,
            'title' => $this->title
        ];
    }
}
