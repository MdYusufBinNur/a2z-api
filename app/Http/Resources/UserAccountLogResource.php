<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class UserAccountLogResource extends Resource
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
            'updatedByUserId' => $this->updatedByUserId,

            'userAccountId' => $this->userId,
            'userAccount' => $this->when($this->needToInclude($request, 'userAccountLog.userAccount'), function () {
                return new UserAccountResource($this->userAccount);
            }),

            'resourceId' => $this->resourceId,
            'resourceType' => $this->resourceType,

            'type' => $this->type,
            'method' => $this->method,
            'amount' => $this->amount,
            'reason' => $this->reason,
            'date' => $this->date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
