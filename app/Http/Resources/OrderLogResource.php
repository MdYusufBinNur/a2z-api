<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class OrderLogResource extends Resource
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
            'assignedToUserId' => $this->assignedToUserId,

            'orderId' => $this->orderId,
            'order' => $this->when($this->needToInclude($request, 'ol.order'), function () {
                return new OrderResource($this->order);
            }),

            'status' => $this->status,
            'comments' => $this->comments,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
