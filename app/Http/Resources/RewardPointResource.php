<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class RewardPointResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id' => $this->getIdOrUuid(),
            'createdByUserId' => $this->createdByUserId,
            'userId' => $this->userId, //User Id
            'total' => $this->total,
            'used' => $this->used,
            'availablePerUses' => $this->availablePerUses,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
