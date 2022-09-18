<?php

namespace App\Http\Resources;

use App\DbModels\RefundRequest;
use Illuminate\Http\Request;

class RefundRequestLogResource extends Resource
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
            'createdByUser' => $this->when($this->needToInclude($request, 'refundRequestLog.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),

            'refundRequestId' => $this->refundRequestId,
            'refundRequest' => $this->when($this->needToInclude($request, 'refundRequestLog.refundRequestId'), function () {
                return new RefundRequest($this->refundRequest);
            }),

            'status' => $this->status,
            'comment' => $this->comment,

            'assignedToUserId' => $this->assignedToUserId,
            'assignedToUser' => $this->when($this->needToInclude($request, 'refundRequestLog.assignedToUser'), function () {
                return new UserResource($this->assignedToUser);
            }),
        ];
    }
}
