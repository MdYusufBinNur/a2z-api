<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class OrderReportCommentResource extends Resource
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
            'createdByUser' => $this->when($this->needToInclude($request, 'or.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),

            'orderReportId' => $this->orderReportId,
            'orderReport' => $this->when($this->needToInclude($request, 'or.orderReport'), function () {
                return new OrderReportResource($this->orderReport);
            }),

            'status' => $this->status,
            'comments' => $this->comments,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
